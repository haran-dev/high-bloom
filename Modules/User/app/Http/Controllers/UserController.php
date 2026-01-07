<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\ActivityLog;
use App\Events\ActivityLogged;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Modules\User\app\Http\Requests\UserProfileRequest;
use Modules\User\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ActivityNotification;

class UserController extends Controller
{
    public function index()
    {
        $details = Auth::user();
        return view('user::profile.list', compact('details'));
    }

    public function store(UserProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataObject = (object) $request->all();
            $user = Auth::user();

            $userName = Str::slug($user->name);
            $job      = Str::slug($user->job ?? 'owner');
            $dateTime = now()->format('Ymd-His');

            $folderPath = "users/{$userName}/profile-img";

            $userDetails = [
                'name'      => $dataObject->fullName,
                'about'     => $dataObject->about ?? null,
                'country'   => $dataObject->country ?? null,
                'address'   => $dataObject->address ?? null,
                'phone'     => $dataObject->phone ?? null,
                'twitter'   => $dataObject->twitter ?? null,
                'facebook'  => $dataObject->facebook ?? null,
                'instagram' => $dataObject->instagram ?? null,
                'linkedin'  => $dataObject->linkedin ?? null,
            ];

            if ($request->hasFile('profile_image')) {

                $extension = strtolower($request->file('profile_image')->getClientOriginalExtension());
                $fileName  = "{$userName}-profile-image-{$job}-{$dateTime}.{$extension}";

                if ($user->profile_img) {
                    Storage::disk('public')->delete($user->profile_img);
                }

                $path = $request->file('profile_image')->storeAs(
                    $folderPath,
                    $fileName,
                    'public'
                );

                $userDetails['profile_img'] = $path;
            }

            $user->update($userDetails);

            $activity = ActivityLog::create([
                'user_id' => $user->id,
                'company_id' => 1,
                'title' => 'Profile Created',
                'message' => 'You successfully created your profile',
            ]);

            // Broadcast real-time
            event(new ActivityLogged(
                [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'message' => $activity->message,
                    'created_at' => $activity->created_at->diffForHumans(),
                ],
                $user->id
            ));


            $user->notify(
                new ActivityNotification('Your profile was updated successfully.')
            );






            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Profile updated successfully',
                'redirect' => route('user.profile')
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Profile store failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }



    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Update the password
            $user->password = Hash::make($request->newpassword);
            $user->save();

            $activity = ActivityLog::create([
                'user_id' => $user->id,
                'company_id' => 1,
                'title' => 'Profile password Changed',
                'message' => 'You successfully changed your profile password',
            ]);

            // Broadcast real-time
            event(new ActivityLogged(
                [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'message' => $activity->message,
                    'created_at' => $activity->created_at->diffForHumans(),
                ],
                $user->id
            ));


            $user->notify(
                new ActivityNotification('Password Changed', 'Your profile password was changed successfully.')
            );



            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Password changed successfully',
                'redirect' => route('user.profile')
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Password change failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }




    public function show($id)
    {
        return view('user::show');
    }


    public function edit($id)
    {
        return view('user::edit');
    }


    public function update(Request $request, $id) {}


    public function destroy($id) {}





    public function markAllRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead(); // Marks all unread as read

        return response()->json(['status' => true]);
    }

    public function markRead($id)
    {
        $notification = auth()->user()->unreadNotifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false], 404);
    }
}

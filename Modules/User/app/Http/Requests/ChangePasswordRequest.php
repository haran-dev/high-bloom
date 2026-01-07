<?php

namespace Modules\User\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow logged-in users
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string'], // current password
            'newpassword' => [
                'required',
                'string',
                'confirmed', // must match newpassword_confirmation
                Password::min(8)
                    ->letters()        // at least one letter
                    ->mixedCase()      // at least one uppercase & lowercase
                    ->numbers()        // at least one number
                    ->symbols()        // at least one symbol
            ],
            'newpassword_confirmation' => ['required', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if current password matches
            if (! Hash::check($this->password, $this->user()->password)) {
                $validator->errors()->add('password', 'Current password is incorrect.');
            }
        });
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Http\Controllers\UserController;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class)->names('user');
});


Route::middleware(['web', 'auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/profile', [UserController::class, 'index'])
            ->name('profile');

        Route::post('/profile/update', [UserController::class, 'store'])
            ->name('profile-update');

        Route::post('/profile/password/update', [UserController::class, 'changePassword'])
            ->name('profile-password-update');
    });



Route::middleware(['auth'])->group(function () {
    Route::post('notifications/mark-all-read', [UserController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::post('notifications/{id}/mark-read', [UserController::class, 'markRead'])->name('notifications.markRead');
});
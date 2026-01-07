<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\app\Http\Controllers\CompanyController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('companies', CompanyController::class)->names('company');
// });



Route::middleware(['web', 'auth'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {
        Route::get('/', [CompanyController::class, 'index'])
            ->name('company');

        Route::post('/profile/update', [CompanyController::class, 'store'])
            ->name('profile-update');

        Route::post('/profile/password/update', [CompanyController::class, 'changePassword'])
            ->name('profile-password-update');

        Route::get('/add', [CompanyController::class, 'create'])
            ->name('create');

    });
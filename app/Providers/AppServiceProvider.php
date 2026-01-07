<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Company;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = auth()->user(); // currently logged-in user
            $company = $user ? $user->company : null; // if user has company relation

            $view->with([
                'authUser' => $user,
                'userCompany' => $company,
            ]);
        });
    }
}

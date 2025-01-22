<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
    public function boot()
    {
        // مشاركة عدد الإشعارات غير المقروءة مع جميع القوالب
        View::composer('*', function ($view) {
            $view->with('unreadNotificationsCount', Auth::check() ? Auth::user()->unreadNotifications->count() : 0);
        });
    }
}

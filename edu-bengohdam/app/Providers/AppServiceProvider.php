<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        View::composer('layouts.admin', function ($view) {

            $feedbackCount = DB::table('coursefeedback')->count();

            $forgotRequests = DB::table('users')
                ->where('forgot_password', 1)
                ->count();

            $announcementReview = DB::table('announcements')
                ->where('status', 'pending')
                ->count();

            $totalNotifications = $feedbackCount + $forgotRequests + $announcementReview;

            $view->with(compact(
                'feedbackCount',
                'forgotRequests',
                'announcementReview',
                'totalNotifications'
            ));
        });
    }
}

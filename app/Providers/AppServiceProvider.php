<?php

namespace App\Providers;

use App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->share('project', Helpers::isWeekday());
        view()->share('weekStartDate', Helpers::weekStartEndDate());
        view()->share('weekEndDate',  Helpers::weekStartEndDate(false));
    }
}

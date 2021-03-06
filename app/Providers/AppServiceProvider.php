<?php

namespace App\Providers;

use App\Status;
use App\Tag;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        \View::composer('*', function ($view) {
            $view->with('assignedUsers', User::all())
                ->with('statuses', Status::all())
                ->with('tags', Tag::all());
        });
    }
}

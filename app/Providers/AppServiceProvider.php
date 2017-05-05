<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;
use App\User;
use App\Observers\PostObserver;
//use Illuminate\Support\Facades\Validator;
use Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Post::observe(PostObserver::class);

        Validator::extend('old_password', 'App\Validator\CustomValidator@validateOldPassword');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

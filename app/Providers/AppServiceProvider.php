<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\Contracts\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->bind('App\Repositories\Contracts\CategoryRepositoryInterface', 'App\Repositories\CategoryRepository');
        $this->app->bind('App\Repositories\Contracts\ArticleRepositoryInterface', 'App\Repositories\ArticleRepository');
        $this->app->bind('App\Repositories\Contracts\FileRepositoryInterface', 'App\Repositories\FileRepository');
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

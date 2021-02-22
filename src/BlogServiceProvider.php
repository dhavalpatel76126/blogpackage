<?php

namespace Cct\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // load routes.
        $this->app['router']
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/blog.php');
            });

        // load view.
        $this->loadViewsFrom(__DIR__ . '/views', 'blog');

        // load migration.
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // publish views
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/blog/'),
        ], 'views');

        // publish route 
        $this->publishes([
            __DIR__ . '/routes/blog.php' => 'routes/blog.php',
        ], 'route');

        // publish controller 
        $this->publishes([
            __DIR__ . '/Http/Controllers' => 'app/http/controllers/',
        ], 'controller');

        // publish middleware
        $this->publishes([
            __DIR__ . '/Http/Middleware' => 'app/http/Middleware/',
        ], 'middleware');

        // publish models
        $this->publishes([
            __DIR__ . '/Models' => 'app/Models/',
        ], 'Models');
    }


    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'blog');
    }
}

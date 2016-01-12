<?php

namespace Thanosalexander\Activity;

use Illuminate\Support\ServiceProvider;
use Thanosalexander\Activity\Activity\Activity;
use Thanosalexander\Activity\Activity\Types\Type;

class ActivityServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/config/activities.php' => config_path('activities.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__.'/Http/routes.php';

        $this->app->make('Thanosalexander\Activity\Http\Controllers\ActivityController');
        $this->app->make('Thanosalexander\Activity\Http\Controllers\TypeController');

        $this->app->bind('activity',function()
        {
            return new Activity();
        });

        $this->app->bind('type',function()
        {
            return new Type();
        });

    }
}

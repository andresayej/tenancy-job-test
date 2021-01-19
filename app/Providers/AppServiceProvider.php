<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Events\DatabaseMigrated;

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
        Event::listen(DatabaseMigrated::class, JobPipeline::make([
            \App\Jobs\InsertUserJob::class
        ])->send(function (DatabaseMigrated $event) {
            return $event->tenant;
        })->shouldBeQueued(true)->toListener());
    }
}

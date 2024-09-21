<?php

namespace Binafy\LaravelReaction\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelReactionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-reaction.php', 'laravel-reactions');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/laravel-reaction.php' => config_path('laravel-reaction.php'),
        ], 'laravel-reactions-config');

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations')
        ], 'laravel-reactions-migrations');
    }
}

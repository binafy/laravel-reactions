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
}

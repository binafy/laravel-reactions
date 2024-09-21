<?php

namespace Tests;

use Binafy\LaravelReaction\Providers\LaravelReactionServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelReactionServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Set default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Set app key
        $app['config']->set('app.key', 'base64:'.base64_encode(
            Encrypter::generateKey(config()['app.cipher'])
        ));

        // Set user model
        $app['config']->set('auth.providers.users.model', User::class);

        // Set user model for monitoring config
        $app['config']->set('laravel-reactions.user.model', User::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/SetUp/Migrations');

        Artisan::call('migrate');

        User::query()->create([
            'name' => 'milwad',
            'email' => 'milwad@gmail.com',
            'password' => bcrypt('password'),
        ]);
        Post::query()->create(['title' => 'new post']);
    }
}

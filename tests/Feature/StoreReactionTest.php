<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('user can store reaction with reaction enum', function () {
    $user = User::query()->create([
        'name' => 'milwad',
        'email' => 'milwad@gmail.com',
        'password' => bcrypt('password'),
    ]);
    $post = Post::query()->create(['title' => 'new post']);

    $user->reaction(LaravelReactionTypeEnum::REACTION_ANGRY->value, $post);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => LaravelReactionTypeEnum::REACTION_ANGRY->value]);
    assertDatabaseCount('reactions', 1);
});

test('user can store reaction with custom reaction type', function () {
    $user = User::query()->create([
        'name' => 'milwad',
        'email' => 'milwad@gmail.com',
        'password' => bcrypt('password'),
    ]);
    $post = Post::query()->create(['title' => 'new post']);

    $user->reaction('fun', $post);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => 'fun']);
    assertDatabaseCount('reactions', 1);
});

test('user can store reaction from reactionble', function () {
    $user = User::query()->create([
        'name' => 'milwad',
        'email' => 'milwad@gmail.com',
        'password' => bcrypt('password'),
    ]);
    $post = Post::query()->create(['title' => 'new post']);

    $post->reaction('fun', $user);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => 'fun']);
    assertDatabaseCount('reactions', 1);
});

<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('user can store reaction with reaction enum', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_ANGRY, $post);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => LaravelReactionTypeEnum::REACTION_ANGRY->value]);
    assertDatabaseCount('reactions', 1);
});

test('user can store reaction with custom reaction type', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction('fun', $post);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => 'fun']);
    assertDatabaseCount('reactions', 1);
});

test('user can store reaction from reactionble', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $post->reaction('fun', $user);

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => 'fun']);
    assertDatabaseCount('reactions', 1);
});

test('login user can store reaction from reactionble', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();

    $post->reaction('fun');

    assertDatabaseHas('reactions', ['user_id' => $user->id, 'type' => 'fun']);
    assertDatabaseCount('reactions', 1);
});

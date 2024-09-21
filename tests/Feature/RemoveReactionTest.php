<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseMissing;

test('user can remove all reactions', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_FIRE->value, $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReactions($post);

    // DB Assertions
    assertDatabaseMissing('reactions', ['reactable_id' => $post->id]);
    assertDatabaseCount('reactions', 0);
});

test('user can remove one reaction with enum', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_FIRE->value, $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReaction(LaravelReactionTypeEnum::REACTION_FIRE, $post);

    // DB Assertions
    assertDatabaseCount('reactions', 1);
});

test('user can remove one reaction with custom type', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction('fun', $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReaction('fun', $post);

    // DB Assertions
    assertDatabaseCount('reactions', 1);
});

test('user can not remove one reaction when type is wrong', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $isDeleted = $user->removeReaction('fun', $post);

    \PHPUnit\Framework\assertFalse($isDeleted);

    // DB Assertions
    assertDatabaseCount('reactions', 1);
});

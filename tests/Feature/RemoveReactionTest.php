<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Binafy\LaravelReaction\Events\RemoveAllReactionEvent;
use Binafy\LaravelReaction\Events\RemoveReactionEvent;
use Illuminate\Support\Facades\Event;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseMissing;
use function PHPUnit\Framework\assertFalse;

test('user can remove all reactions', function () {
    Event::fake();

    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_FIRE->value, $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReactions($post);

    // DB Assertions
    assertDatabaseMissing('reactions', ['reactable_id' => $post->id]);
    assertDatabaseCount('reactions', 0);

    Event::assertDispatched(RemoveAllReactionEvent::class);
});

test('user can remove one reaction with enum', function () {
    Event::fake();

    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_FIRE->value, $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReaction(LaravelReactionTypeEnum::REACTION_FIRE, $post);

    // DB Assertions
    assertDatabaseCount('reactions', 1);

    Event::assertDispatched(RemoveReactionEvent::class);
});

test('user can remove one reaction with custom type', function () {
    Event::fake();

    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction('fun', $post);
    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $user->removeReaction('fun', $post);

    // DB Assertions
    assertDatabaseCount('reactions', 1);

    Event::assertDispatched(RemoveReactionEvent::class);
});

test('user can not remove one reaction when type is wrong', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $user->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $post);

    // Remove reaction
    $isDeleted = $user->removeReaction('fun', $post);

    assertFalse($isDeleted);

    // DB Assertions
    assertDatabaseCount('reactions', 1);
});

test('user can remove one reaction with reactable and type', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);

    // Remove reaction
    $post->removeReaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);

    // DB Assertions
    assertDatabaseCount('reactions', 0);
});

test('login user can remove one reaction with reactable and type', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    // Remove reaction
    $post->removeReaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    // DB Assertions
    assertDatabaseCount('reactions', 0);
});

test('user can remove all reactions with reactable', function () {
    $user = User::query()->first();
    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);

    // Remove reaction
    $post->removeReactions($user);

    // DB Assertions
    assertDatabaseCount('reactions', 0);
});

test('login user can remove all reactions with reactable', function () {
    Event::fake();

    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, );

    // Remove reaction
    $post->removeReactions();

    // DB Assertions
    assertDatabaseCount('reactions', 0);

    Event::assertDispatched(RemoveAllReactionEvent::class);
});

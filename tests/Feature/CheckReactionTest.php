<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;
use function PHPUnit\Framework\assertTrue;

test('user can check is reacted to a reactable', function () {
    $user = User::query()->first();
    $post = Post::query()->first();
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);

    $isReacted = $post->isReacted($user);

    assertTrue($isReacted);
});

test('login user can check is reacted to a reactable', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    $isReacted = $post->isReacted();

    assertTrue($isReacted);
});

test('login user can check is reacted to a reactable with attribute', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    $isReacted = $post->is_reacted;

    assertTrue($isReacted);
});

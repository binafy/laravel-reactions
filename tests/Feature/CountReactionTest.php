<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;
use function PHPUnit\Framework\assertEquals;

test('get react count by type', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    $user2 = User::query()->create(['name' => 'test', 'email' => 'test@gmail.com', 'password' => bcrypt(12345)]);
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user2);

    assertEquals(
        $post->getReactCountByType(LaravelReactionTypeEnum::REACTION_CLAP->value),
        2
    );
});

test('getReactionsWithCount method work correctly', function () {
    $user = User::query()->first();
    $user2 = User::query()->create([
        'name' => 'User 2',
        'email' => 'user2@gmail.com',
        'password' => bcrypt(123456),
    ]);
    $user3 = User::query()->create([
        'name' => 'User 3',
        'email' => 'user3@gmail.com',
        'password' => bcrypt(123456),
    ]);
    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user2);
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user3);

    assertEquals(
        $post->getReactionsWithCount()->toArray(),
        [LaravelReactionTypeEnum::REACTION_CLAP->value => 3],
    );
});

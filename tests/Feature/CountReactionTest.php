<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Binafy\LaravelReaction\Models\Reaction;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;

test('get react count by type', function () {
    $user = User::query()->first();
    auth()->login($user);

    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value);

    $user2 = User::query()->create(['name' => 'test', 'email' => 'test@gmail.com', 'password' => bcrypt(12345)]);
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user2);

    \PHPUnit\Framework\assertEquals(
        $post->getReactCountByType(LaravelReactionTypeEnum::REACTION_CLAP->value),
        2
    );
});

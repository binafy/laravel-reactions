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

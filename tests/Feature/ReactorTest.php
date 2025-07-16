<?php

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Tests\SetUp\Models\Post;
use Tests\SetUp\Models\User;
use function PHPUnit\Framework\assertEquals;

test('getReactors method return all reactors of reactions', function () {
    $user = User::query()->first();
    User::query()->create([
        'name' => 'User 2',
        'email' => 'user2@gmail.com',
        'password' => bcrypt(123456),
    ]);
    $user2 = User::query()->firstWhere('name', 'User 2');
    $post = Post::query()->first();

    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user);
    $post->reaction(LaravelReactionTypeEnum::REACTION_CLAP->value, $user2);

    assertEquals(
        $post->getReactors()->toArray(),
        [$user->toArray(), $user2->toArray()],
    );
});

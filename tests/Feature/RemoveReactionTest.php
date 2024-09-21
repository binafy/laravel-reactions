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

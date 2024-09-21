<?php

namespace Binafy\LaravelReactions\Traits;

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Binafy\LaravelReaction\Models\Reaction;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait Reactable
{
    use HasRelationships;

    /**
     * Relation morph.
     */
    public function reactions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    /**
     * React to reactable.
     */
    public function reaction(string|LaravelReactionTypeEnum $type, \Illuminate\Foundation\Auth\User|null $user = null): Reaction
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $user->reaction($type, $this);
    }
}

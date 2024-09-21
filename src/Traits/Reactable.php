<?php

namespace Binafy\LaravelReaction\Traits;

use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Binafy\LaravelReaction\Models\Reaction;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Foundation\Auth\User;

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
    public function reaction(string|LaravelReactionTypeEnum $type, User|null $user = null): Reaction
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $user->reaction($type, $this);
    }

    /**
     * Remove reaction if exists.
     */
    public function removeReaction(string|LaravelReactionTypeEnum $type, User|null $user = null): bool
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $user->removeReaction($type, $this);
    }

    /**
     * Remove all reactions if exists.
     */
    public function removeReactions(User|null $user = null): bool
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $user->removeReactions($this);
    }

    /**
     * Check reactable is reacted by the user.
     */
    public function isReacted(User|null $user = null): bool
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        return $this->reactions()->whereBelongsTo($user)->exists();
    }

    /**
     * Get react count by type.
     */
    public function getReactCountByType(string|LaravelReactionTypeEnum $type): int
    {
        return $this->reactions()->where('type', $type)->count();
    }
}

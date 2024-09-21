<?php

namespace Binafy\LaravelReactions\Traits;

use Binafy\LaravelReaction\Models\Reaction;
use Binafy\LaravelReaction\Contracts\HasReaction;
use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait Reactor
{
    use HasRelationships;

    /**
     * React to reactable.
     */
    public function reaction(string|LaravelReactionTypeEnum $type, HasReaction $reactable): Reaction
    {
        $userForeignName = config('laravel-relations.user.foreign_key', 'user_id');

        if ($type instanceof LaravelReactionTypeEnum) {
            $type = $type->value;
        }

        return $reactable->reactions()->firstOrCreate([
            $userForeignName => $this->getKey(),
            'type' => $type,
            'reactable_id' => $reactable->getKey(),
            'reactable_type' => $reactable::class,
        ]);
    }

    /**
     * Remove reaction if exists.
     */
    public function removeReaction(HasReaction $reactable): bool
    {
        $userForeignName = config('laravel-relations.user.foreign_key', 'user_id');

        $reactable = $reactable->reactions()->first([$userForeignName => $this->getKey()]);

        if (! $reactable) {
            return false;
        }

        $reactable->delete();

        return true;
    }
}

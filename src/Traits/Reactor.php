<?php

namespace Binafy\LaravelReaction\Traits;

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
     * Remove reactions if exists.
     */
    public function removeReactions(HasReaction $reactable): bool
    {
        $userForeignName = config('laravel-relations.user.foreign_key', 'user_id');

        $reactable->reactions()
            ->where([$userForeignName => $this->getKey()])
            ->delete();

        return true;
    }
}

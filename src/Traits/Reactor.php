<?php

namespace Binafy\LaravelReaction\Traits;

use Binafy\LaravelReaction\Contracts\HasReaction;
use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Binafy\LaravelReaction\Events\RemoveAllReactionEvent;
use Binafy\LaravelReaction\Events\RemoveReactionEvent;
use Binafy\LaravelReaction\Events\StoreReactionEvent;
use Binafy\LaravelReaction\Models\Reaction;
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

        // Store reaction
        $reaction = $reactable->reactions()->firstOrCreate([
            $userForeignName => $this->getKey(),
            'type' => $type,
            'reactable_id' => $reactable->getKey(),
            'reactable_type' => $reactable::class,
        ]);

        // Dispatch event
        StoreReactionEvent::dispatch($reaction);

        return $reaction;
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

        // Dispatch event
        RemoveAllReactionEvent::dispatch();

        return true;
    }

    /**
     * Remove reaction if exists.
     */
    public function removeReaction(string|LaravelReactionTypeEnum $type, HasReaction $reactable): bool
    {
        $userForeignName = config('laravel-relations.user.foreign_key', 'user_id');

        if ($type instanceof LaravelReactionTypeEnum) {
            $type = $type->value;
        }

        $reactable = $reactable->reactions()
            ->where([$userForeignName => $this->getKey(), 'type' => $type])
            ->first();

        if (!$reactable) {
            return false;
        }

        $reactable->delete();

        // Dispatch event
        RemoveReactionEvent::dispatch();

        return true;
    }
}

<?php

namespace Binafy\LaravelReactions\Traits;

use App\Models\Reaction;
use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait Reactor
{
    use HasRelationships;

    /**
     * React to reactable.
     */
    public function react(string|LaravelReactionTypeEnum $type, $reactable): Reaction
    {
        $userForeignName = config('laravel-relations.user.foreign_key', 'user_id');

        if ($type instanceof LaravelReactionTypeEnum) {
            $type = $type->value;
        }

        $react = $reactable->reactions()
            ->where([
                $userForeignName => $this->getKey(),
                'type' => $type,
                'reactable_id' => $reactable->getKey(),
                'reactable_type' => $reactable::class,
            ])->first();

        if (! $react) {
            return $this->storeReact($type, $reactable);
        }

        return $react;
    }
}

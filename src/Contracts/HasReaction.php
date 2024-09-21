<?php

namespace Binafy\LaravelReaction\Contracts;

interface HasReaction
{
    /**
     * Relation morph.
     */
    public function reactions(): \Illuminate\Database\Eloquent\Relations\MorphMany;
}

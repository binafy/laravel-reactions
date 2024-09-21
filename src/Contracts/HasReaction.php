<?php

namespace Binafy\LaravelReaction\Contracts;

interface HasReaction
{
    /**
     * Relation morph.
     */
    public function reactions(): \Illuminate\Database\Eloquent\Relations\MorphMany;

    /**
     * Get the value of the model's primary key.
     */
    public function getKey();
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    /**
     * Guarded columns.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('laravel-reactions.table', 'reactions'));
    }

    // Relations

    /**
     * Reactable morph relation.
     */
    public function reactable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation one-to-many, User model.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(
            config('laravel-reactions.user.model'),
            config('laravel-reactions.user.foreign_key')
        );
    }
}

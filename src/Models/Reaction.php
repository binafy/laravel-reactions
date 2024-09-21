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
}

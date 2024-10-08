<?php

namespace Tests\SetUp\Models;

use Binafy\LaravelReaction\Contracts\HasReaction;
use Binafy\LaravelReaction\Traits\Reactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements HasReaction
{
    use HasFactory, Reactable;

    protected $guarded = ['id'];
}

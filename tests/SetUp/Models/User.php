<?php

namespace Tests\SetUp\Models;

use Binafy\LaravelReactions\Traits\Reactor;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Reactor;

    /**
     * Set fillable for columns.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * Set column to hidden for columns.
     *
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Cast columns.
     *
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

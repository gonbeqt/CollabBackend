<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use MongoDB\Laravel\Eloquent\Model;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use \MongoDB\Laravel\Eloquent\HybridRelations;

    protected $connection = 'mongodb';
    protected $collection = 'personal_access_tokens';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'tokenable_type',
        'tokenable_id',
        'last_used_at',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tokenable model that the access token belongs to.
     */
    public function tokenable()
    {
        return $this->morphTo();
    }
}
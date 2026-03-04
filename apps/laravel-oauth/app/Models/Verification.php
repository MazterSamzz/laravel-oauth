<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'unique_id';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

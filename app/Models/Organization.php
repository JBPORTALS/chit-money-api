<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }
}

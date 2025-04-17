<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(BatchSubscriber::class, "subscriber_id");
    }
}

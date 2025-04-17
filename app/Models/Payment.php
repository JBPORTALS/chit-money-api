<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(BatchSubscriber::class, "subscriber_id");
    }

    public function creditScore(): HasOne
    {
        return $this->hasOne(CreditScore::class);
    }
}

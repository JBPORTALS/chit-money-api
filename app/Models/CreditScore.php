<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditScore extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, "payment_id");
    }
}

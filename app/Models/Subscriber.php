<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Subscriber extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function contactDetails(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function bankDetails(): HasOne
    {
        return $this->hasOne(BankDetail::class);
    }

    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(BatchSubscriber::class, "batch_subscriber", "subscriber_id", "batch_id")->withPivot('chit_id');
    }
}

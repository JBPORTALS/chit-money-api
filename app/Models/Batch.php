<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Batch extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(BatchSubscriber::class, "batch_subscriber", "batch_id", "subscriber_id")->withPivot('chit_id');
    }
}

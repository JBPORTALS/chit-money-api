<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Batch extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    protected $fillable = [
        "name",
        "batch_type",
        "starts_on",
        "ends_on",
        "due_date",
        "scheme",
        "fund_amount",
        "commission_rate"
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(BatchSubscriber::class, "batch_subscriber", "batch_id", "subscriber_id")->withPivot('chit_id');
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, BatchSubscriber::class, "batch_subsriber_id", "batch_id");
    }
}

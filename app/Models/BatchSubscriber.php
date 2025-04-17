<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BatchSubscriber extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';
    protected $table = 'batch_subscriber';

    public function subscribers(): BelongsToMany
    {
        return $this->BelongsToMany(Subscriber::class);
    }

    public function batches(): BelongsToMany
    {
        return $this->BelongsToMany(Batch::class);
    }
}

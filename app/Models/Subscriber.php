<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}

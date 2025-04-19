<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Collector extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'dob',
        'aadhar_back_photo_key',
        'aadhar_front_photo_key'
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function bankDetails(): HasOne
    {
        return $this->hasOne(BankDetail::class);
    }
}

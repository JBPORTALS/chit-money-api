<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    public function contactDetails()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function bankDetails()
    {
        return $this->belongsTo(BankDetail::class, 'bank_details_id');
    }
}

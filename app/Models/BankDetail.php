<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankDetail extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';

    protected $fillable = [
        "account_holder_name",
        "account_number",
        "account_type",
        "branch_name",
        "upi_id",
        "ifsc_code",
        "city",
        "state",
        "pincode"
    ];

    public function collector(): HasOne
    {
        return $this->hasOne(Collector::class);
    }
}

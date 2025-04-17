<?php

namespace Database\Seeders;

use App\Models\CreditScore;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class CreditScoreSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = Payment::all();
        foreach ($payments as $payment) {
            CreditScore::factory()->state(["payment_id" => $payment->id])->create();
        }
    }
}

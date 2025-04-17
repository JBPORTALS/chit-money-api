<?php

namespace Database\Seeders;

use App\Models\BatchSubscriber;
use App\Models\Payment;
use App\Models\Payout;
use Illuminate\Database\Seeder;

class PayoutSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batchSubscribers = BatchSubscriber::all();
        foreach ($batchSubscribers as $batchSubscriber) {
            Payout::factory()->count(1)->state(["batch_subscriber_id" => $batchSubscriber->id])->create();
        }
    }
}

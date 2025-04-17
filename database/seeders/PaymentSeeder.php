<?php

namespace Database\Seeders;

use App\Models\BatchSubscriber;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batchSubscribers = BatchSubscriber::all();
        foreach ($batchSubscribers as $batchSubscriber) {
            Payment::factory()->count(4)->state(["batch_subscriber_id" => $batchSubscriber->id])->create();
        }
    }
}

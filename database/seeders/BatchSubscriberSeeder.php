<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\BatchSubscriber;
use App\Models\Collector;
use App\Models\Organization;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;
use Faker\Factory;

class BatchSubscriberSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $subscribers = Subscriber::all();

        $batches = Batch::all();

        foreach ($batches as $batch) {
            //select random 8 subscribers
            $randomSubscribers = $faker->randomElements($subscribers, 8);
            echo "👥 Subscriber joining to batch....";
            foreach ($randomSubscribers as $subscriber) {
                BatchSubscriber::factory()->state(["subscriber_id" => $subscriber->id, "batch_id" => $batch->id]);
            }
        }
    }
}

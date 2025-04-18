<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;
use Faker\Factory;

class SubscriberSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        Subscriber::factory()->count(20)->create();
    }
}

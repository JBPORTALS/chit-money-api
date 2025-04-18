<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Collector;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CollectorSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        Collector::factory()->count(5)->has(
            Organization::factory()->has(Batch::factory()->count(3))->count(1)
        )->create();
    }
}


// has( //Every collector will have 1 Organization
//     Batch::factory()->hasAttached( // Every Organization will have 3 Batches in it
//         Subscriber::factory()->count(8), // Every Batch will have 8 members subscribed to it
//         ["chit_id" => $faker->numerify("CHIT######")]
//     )->count(3)
// )
// )
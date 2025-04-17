<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Collector;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class CollectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collector::factory()->count(5)->has(
            Organization::factory()->count(1)->has( //Every collector will have 1 Organization
                Batch::factory()->count(3) // Every Organization will have 3 Batches in it
            )
        )->create();
    }
}

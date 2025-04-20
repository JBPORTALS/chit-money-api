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
        Collector::factory()->has(Organization::factory()->has(Batch::factory()->count(3))->count(1))->count(5)->create();
    }
}
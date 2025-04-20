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
        $collectors = Collector::factory()->count(5)->create()->all();
        foreach ($collectors as $collector) {
            Organization::factory()->state(["collector_id" => $collector->id])->has(Batch::factory()->count(3))->count(1);
        }
    }
}
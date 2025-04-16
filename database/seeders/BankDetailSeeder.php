<?php

namespace Database\Seeders;

use App\Models\BankDetail;
use Illuminate\Database\Seeder;

class BankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankDetail::factory()->count(5)->create();
    }
}

<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->company(),
            "batch_type" => $this->faker->randomElement(["auction", "interest"]),
            "starts_on" => $this->faker->date(),
            "ends_on" => $this->faker->date(),
            "due_date" => $this->faker->randomElement([20, 10, 15]),
            "scheme" => $this->faker->randomElement([20, 10, 15]),
            "fund_amount" => $this->faker->randomElement([200000, 500000, 100000]),
            "batch_status" => $this->faker->randomElement(["upcoming", "active", "completed"]),
            "commission_rate" => $this->faker->randomDigitNotZero()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\CreditScore;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditScoreFactory extends Factory
{
    protected $model = CreditScore::class;

    public function definition(): array
    {
        // Generate a random number between -10 and 10 (excluding 0)
        $score = 0;
        while ($score === 0) {
            $score = $this->faker->numberBetween(-10, 10);
        }

        return [
            "score" => $score,
        ];
    }
}

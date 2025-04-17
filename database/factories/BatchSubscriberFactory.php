<?php

namespace Database\Factories;

use App\Models\BatchSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchSubscriberFactory extends Factory
{
    protected $model = BatchSubscriber::class;

    public function definition(): array
    {
        return [
            'chit_id' => $this->faker->numerify("CHIT######"),
        ];
    }
}

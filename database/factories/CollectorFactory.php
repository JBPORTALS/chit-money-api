<?php

namespace Database\Factories;

use App\Models\BankDetail;
use App\Models\Collector;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectorFactory extends Factory
{
    protected $model = Collector::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "dob" => $this->faker->date(),
            "aadhar_front_photo_key" => $this->faker->lexify('ut_?????????'),
            "aadhar_back_photo_key" => $this->faker->lexify('ut_?????????'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Collector $collector) {
            $collector->bank_details_id = BankDetail::factory()->create()->id;
            $collector->contact_id = Contact::factory()->create()->id;
            $collector->save();
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\BankDetail;
use App\Models\Contact;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;

    public function definition(): array
    {
        return [
            "display_userId" => $this->faker->numerify("SUB######"),
            "name" => $this->faker->name(),
            "dob" => $this->faker->date(),
            "aadhar_front_photo_key" => $this->faker->lexify('ut_?????????'),
            "aadhar_back_photo_key" => $this->faker->lexify('ut_?????????'),
            "pan_number" => strtoupper($this->faker->bothify('?????####?')),
            "nominee_name" => $this->faker->name(),
            "nominee_relationship" => $this->faker->randomElement(["Mother", "Father", "Brother", "Sister"]),
            "nominee_phone_number" => $this->faker->numerify("##########"),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Subscriber $subscriber) {
            $subscriber->bank_details_id = BankDetail::factory()->create()->id;
            $subscriber->contact_id = Contact::factory()->create()->id;
            $subscriber->save();
        });
    }
}

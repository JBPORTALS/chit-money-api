<?php

namespace Database\Factories;

use App\Models\BankDetail;
use App\Models\Collector;
use App\Models\Contact;
use Clerk\Backend\ClerkBackend;
use Clerk\Backend\Models\Operations\CreateUserRequestBody;
use Clerk\Backend\Models\Operations\CreateUserResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectorFactory extends Factory
{
    protected $model = Collector::class;

    public function createUser(): CreateUserResponse
    {
        $clerk = ClerkBackend::builder()->setSecurity(getenv("CLERK_SECRET_KEY"))->build();
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $email = $this->faker->email();
        [$username, $domain] = explode('@', $email);
        $email = "{$username}+clerk_test@{$domain}";
        $request = new CreateUserRequestBody(emailAddress: [$email], firstName: $firstName, lastName: $lastName, password: "test1234.com", publicMetadata: ["role" => "collector"]);
        $response = $clerk->users->create($request);

        return $response;
    }

    public function definition(): array
    {
        $response = $this->createUser();
        $collector = $response->user;

        return [
            "id" => $collector->id,
            "name" => "$collector->firstName $collector->lastName",
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

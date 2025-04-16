<?php

namespace Database\Factories;

use App\Models\BankDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankDetailFactory extends Factory
{
    protected $model = BankDetail::class;

    protected $banks = [
        'SBIN' => 'State Bank of India',
        'HDFC' => 'HDFC Bank',
        'ICIC' => 'ICICI Bank',
        'UTIB' => 'Axis Bank',
        'PUNB' => 'Punjab National Bank',
        'IDIB' => 'Indian Bank',
    ];

    public function definition(): array
    {
        $bankCode = array_rand($this->banks);

        return [
            "account_holder_name" => $this->faker->name(),
            "account_number" => $this->faker->numerify('##############'),
            "ifsc_code" =>  $bankCode . $this->faker->bothify('0######'),
            "branch_name" => $this->faker->city(),
            "account_type" => $this->faker->randomElement(["savings", "current"]),
            "upi_id" => $this->faker->bothify("##########@") . strtolower($bankCode),
            "city" => $this->faker->city(),
            "state" => $this->faker->state(),
            "pincode" => $this->faker->numerify("######"),
        ];
    }
}

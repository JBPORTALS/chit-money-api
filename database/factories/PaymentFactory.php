<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $paymentMode = $this->faker->randomElement(["cash", "online"]);

        return [
            "penalty" => $this->faker->randomElement([300, 500, 600]),
            "subscription_amount" => $this->faker->randomElement([5000, 20000, 10000]),
            "payment_mode" => $paymentMode,
            "transaction_id" => $paymentMode === "online" ? $this->faker->bothify("??##??####??####?#?#?#?#") : null,
            "paid_at" => $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s'),
        ];
    }
}

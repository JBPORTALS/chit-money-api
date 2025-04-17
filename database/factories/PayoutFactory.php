<?php

namespace Database\Factories;

use App\Models\Payout;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayoutFactory extends Factory
{
    protected $model = Payout::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(["requested", "accepted", "rejected", "disbursed", "cancelled"]);
        $paymentMode = $this->faker->randomElement(["cash", "online"]);

        return [
            "month" => $this->faker->randomDigitNotZero(),
            "amount" => $this->faker->randomElement([200000, 500000, 100000]),
            "applied_commision_rate" => $this->faker->randomDigitNotZero(),
            "status" => $status,
            "paid_at" => $status === "disbursed" ? $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s') : null,
            "requested_at" => $status === "requested" ? $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s') : null,
            "accepted_at" => $status === "accepted" ? $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s') : null,
            "rejected_at" => $status === "rejected" ? $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s') : null,
            "cancelled_at" => $status === "cancelled" ? $this->faker->date('Y-m-d') . ' ' . $this->faker->time('H:i:s') : null,
            "payment_mode" => $paymentMode,
            "transaction_id" => $paymentMode === "online" ? $this->faker->lexify("??##??####??####?#?#?#?#") : null,
        ];
    }
}

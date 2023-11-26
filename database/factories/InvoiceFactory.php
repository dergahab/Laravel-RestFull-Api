<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['B', 'P', 'V']);
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 200000),
            'status' => $status,
            'billed_at' => $this->faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
            'paid_at' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
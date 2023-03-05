<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->numberBetween(),
            'is_fraud' => fake()->boolean(),
            'phone_number' => fake()->phoneNumber(),
            'date_of_birth' => fake()->dateTime(),
            'ip_address' => fake()-> ipv4(),
            'iban' => fake()->numerify(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'price' => $this->faker->numberBetween(10, 25) . "00",
            'delivery_option' => $this->faker->randomNumber(1),
            'is_accepted' => $this->faker->randomNumber(1),
            'is_processed' => $this->faker->randomNumber(1),
            'customer_phone' => $this->faker->randomNumber(5, true),
            'customer_email' => $this->faker->email,
            'customer_firstname' => $this->faker->name,
            'customer_lastname' => $this->faker->name
        ];
    }
}

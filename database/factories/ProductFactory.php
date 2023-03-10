<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Perceuse",
            'sluggy_name' => "perceuse",
            'description' => $this->faker->text,
            'price_by_day' => $this->faker->numberBetween(10, 25) . "00",
            'img_path' => "/assets/perceuse.jpg"
        ];
    }
}

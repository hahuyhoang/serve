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
            'name' => $this->faker->name(),
            'title' => 'title'.$this->faker->name(),
            'description' => ' product Define the models default state.', // password
            'price' => 4.1,
            'total_rate' => 0,
            'total_vote' => 0,
            'status' => 1 
        ];
    }
}

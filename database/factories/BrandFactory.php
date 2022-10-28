<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name(),
            'title' => 'title'.$this->faker->name(),
            'background' => "#e7e8f2",
            'border_color' => "#e7e8f2",
            'description' => ' brand Define the models default state.', // password
            'media_id' => 1 // password
            
        ];
    }
}

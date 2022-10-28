<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
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
            'type' => 0,
            'type_media' => "img default",
            'url' => "https://i.ibb.co/h7L78v7/N-i-Loan-tu-i-18-4.jpg",
        ];
    }
}

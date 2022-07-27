<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_name' => $this->faker->name($gender = null),
            'slug_tag' => $this->faker->unique()->slug(),
            'status' => 1,
        ];
    }
}

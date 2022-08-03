<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_name' => $this->faker->name($gender = null),
            'slug_course' => $this->faker->slug(),
            'image' => $this->faker->imageUrl($width = 50, $height = 50),
            'description' => $this->faker->text($maxNbChars = 200),
            'price' => $this->faker->numberBetween($min = 1000, $max = 10000),
            'status' => 1,
        ];
    }
}

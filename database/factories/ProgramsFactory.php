<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Programs;
use App\Models\Lesson;

class ProgramsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->numberBetween($min = 1, $max = 3),
            'file' => $this->faker->imageUrl($width = 50, $height = 50),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'lesson_id' => $this->faker->randomElement(Lesson::pluck('id')),
        ];
    }
}

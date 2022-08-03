<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Programs;
use App\Models\Lesson;

class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'program_name' => $this->faker->name($gender = null),
            'type' => $this->faker->numberBetween($min = 1, $max = 3),
            'file' => $this->faker->imageUrl($width = 50, $height = 50),
            'status' => 1,
            'lesson_id' => $this->faker->randomElement(Lesson::pluck('id')),
        ];
    }
}

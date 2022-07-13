<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\Tag;

class CourseTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'course_id' => $this->faker->randomElement(Course::pluck('id')),
            'tag_id' => $this->faker->randomElement(Tag::pluck('id')),
        ];
    }
}

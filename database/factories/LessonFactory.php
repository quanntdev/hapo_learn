<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as faker;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_lesson' => $this->faker->name($gender = null),
            'slug_lesson' => $this->faker->unique()->slug(),
            'video' => $this->faker->imageUrl($width = 100, $height = 100),
            'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'requirements' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'time_lesson' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'status' => 1,
            'course_id' => $this->faker->randomElement(Course::pluck('id')),
        ];
    }
}

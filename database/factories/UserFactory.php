<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name($gender = null),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->md5(12345678),
            'role' => $this->faker->randomDigit(),
            'avatar' => $this->faker->imageUrl($width = 50, $height = 50),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->e164PhoneNumber(),
            'about_me' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

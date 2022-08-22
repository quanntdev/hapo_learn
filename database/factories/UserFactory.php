<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as faker;
use Illuminate\Support\Facades\Hash;

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
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(12345678),
            'role' => $this->faker->randomDigit(1, 2),
            'avatar' => $this->faker->imageUrl($width = 100, $height = 100),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->e164PhoneNumber(),
            'about_me' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'status' => 1,
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

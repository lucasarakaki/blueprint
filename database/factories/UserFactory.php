<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => password_hash( 'password', PASSWORD_BCRYPT ),
            'remember_token'    => Str::random( 10 ),
        ];
    }
}

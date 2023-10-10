<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'    => fake()->email,
            'name'     => fake()->name,
            'age'      => fake()->numberBetween(1, 100),
            'sex'      => fake()->randomElement(['male', 'female']),
            'birthday' => fake()->date,
            'phone'    => fake()->phoneNumber,
        ];
    }
}

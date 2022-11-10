<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'code'              => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'email'             => $this->faker->unique()->email,
            'name'              => $this->faker->name,
            'password'          => $this->faker->password,
            'role'              => $this->faker->randomElement([1]),
            'gender'            => $this->faker->randomElement(['Male', 'Female']),
            'birthday'          => $this->faker->dateTimeBetween('-30 year', '-18 year'),
        ];
    }
}

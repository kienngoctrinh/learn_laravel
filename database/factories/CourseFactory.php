<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'name' => $this->faker->randomElement(['PHP', 'Java', 'Python', 'SQL', 'C#', 'C++']),
        ];
    }
}

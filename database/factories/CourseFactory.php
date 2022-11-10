<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'name' => $this->faker->unique()->randomElement(['PHP', 'Java', 'Python', 'SQL', 'C#', 'C++', 'React', 'Laravel', 'Vue', 'Angular']),
        ];
    }
}

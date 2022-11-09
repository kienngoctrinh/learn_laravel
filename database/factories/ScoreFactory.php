<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    public function definition()
    {
        return [
            'user_code'   => User::query()->inRandomOrder()->value('code'),
            'course_code' => Course::query()->inRandomOrder()->value('code'),
            'point'       => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}

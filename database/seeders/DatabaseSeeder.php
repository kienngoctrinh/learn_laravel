<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Course::factory(10)->create();
        Score::factory(10)->create();
    }
}

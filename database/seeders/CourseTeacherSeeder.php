<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseTeacher;

class CourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseTeacher::factory()
        ->count(20)
        ->create();
    }
}

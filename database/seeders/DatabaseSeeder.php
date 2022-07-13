<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(ProgramsSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CourseTagSeeder::class);
        $this->call(CourseTeacherSeeder::class);
        $this->call(UserCourseSeeder::class);
        $this->call(UserLessonSeeder::class);
    }
}

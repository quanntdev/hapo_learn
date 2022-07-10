<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        course::create([
            'course_name' => 'Cơ bản về HTML',
            'slug_course' => 'co-ban-ve-html',
            'image' => 'cobanvehtml.jpg',
            'description' => 'repellendus animi alias cupiditate fugit',
            'price' => '100000',
            'status' => '1',
        ]);
    }
}

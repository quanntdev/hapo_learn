<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseTag;

class CourseTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseTag::factory()
        ->count(50)
        ->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::factory()
        ->count(20)
        ->create();
    }
}

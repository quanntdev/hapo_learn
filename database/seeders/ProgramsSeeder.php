<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programs;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Programs::factory()
        ->count(20)
        ->create();
    }
}

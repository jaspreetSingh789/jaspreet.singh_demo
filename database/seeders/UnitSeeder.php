<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'title' => 'unit 1',
            'description' => 'description',
            'duration' => 0,
            'lessons_count' => 0,
        ]);
        Unit::create([
            'title' => 'unit 2',
            'description' => 'description',
            'duration' => 0,
            'lessons_count' => 0,
        ]);
        Unit::create([
            'title' => 'unit 3',
            'description' => 'description',
            'duration' => 0,
            'lessons_count' => 0,
        ]);
    }
}

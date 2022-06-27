<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name' => 'Level 1'
        ]);
        Level::create([
            'name' => 'Level 2'
        ]);
        Level::create([
            'name' => 'Level 3'
        ]);
        Level::create([
            'name' => 'Level 4'
        ]);
        Level::create([
            'name' => 'Level 5'
        ]);
        Level::create([
            'name' => 'Level 6'
        ]);
        Level::create([
            'name' => 'Level 7'
        ]);
        Level::create([
            'name' => 'Level 8'
        ]);
        Level::create([
            'name' => 'Level 9'
        ]);
        Level::create([
            'name' => 'Level 10'
        ]);
    }
}

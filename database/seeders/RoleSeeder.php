<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Https\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);

        \App\Models\Role::create([
            'name' => 'sub_admin',
            'slug' => 'sub_admin',
        ]);

        \App\Models\Role::create([
            'name' => 'trainer',
            'slug' => 'trainer',
        ]);

        \App\Models\Role::create([
            'name' => 'user',
            'slug' => 'user',
        ]);
    }
}

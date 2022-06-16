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
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        \App\Models\Role::create([
            'name' => 'Subadmin',
            'slug' => 'sub-admin',
        ]);

        \App\Models\Role::create([
            'name' => 'Trainer',
            'slug' => 'trainer',
        ]);

        \App\Models\Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'first_name' => 'admin',
            'last_name' => '1',
            'slug' => 'admin-1',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'subadmin',
            'last_name' => '1',
            'slug' => 'subadmin-1',
            'email' => 'subadmin1@gmail.com',
            'password' => 'subadmin123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'subadmin',
            'last_name' => '2',
            'slug' => 'subadmin-2',
            'email' => 'subadmin2@gmail.com',
            'password' => 'subadmin123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);


        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '1',
            'slug' => 'trainer-1',
            'email' => 'trainer1@gmail.com',
            'password' => 'trainer123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '2',
            'slug' => 'trainer-2',
            'email' => 'trainer2@gmail.com',
            'password' => 'trainer123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 2,
        ]);

        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '3',
            'slug' => 'trainer-3',
            'email' => 'trainer3@gmail.com',
            'password' => 'trainer123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 3,
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '1',
            'slug' => 'employ-1',
            'email' => 'employ1@gmail.com',
            'password' => 'employee123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '2',
            'slug' => 'employ-2',
            'email' => 'employ2@gmail.com',
            'password' => 'employee123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '3',
            'slug' => 'employ-3',
            'email' => 'employ3@gmail.com',
            'password' => 'employee123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '4',
            'slug' => 'employ-4',
            'email' => 'employ4@gmail.com',
            'password' => 'employee123',
            'email_status' => 0,
            'status' => 1,
            'created_by' => 1,
        ]);
    }
}

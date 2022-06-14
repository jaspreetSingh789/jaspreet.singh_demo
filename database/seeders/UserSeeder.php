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
            'first_name' => 'john',
            'last_name' => 'cena',
            'email' => 'john@gmail.com',
            'phone_no' => 5456234548,
            'city' => 'london',
            'created_by' => 1,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'subadmin',
            'last_name' => '1',
            'email' => 'subadmin1@gmail.com',
            'phone_no' => 5956231548,
            'city' => 'london',
            'created_by' => 1,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'subadmin',
            'last_name' => '2',
            'email' => 'subadmin2@gmail.com',
            'phone_no' => 455446231548,
            'city' => 'london',
            'created_by' => 1,
            'password' => '00000000', // password
        ]);


        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '1',
            'email' => 'trainer1@gmail.com',
            'phone_no' => 5456559548,
            'city' => 'london',
            'created_by' => 1,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '2',
            'email' => 'trainer2@gmail.com',
            'phone_no' => 54562655248,
            'city' => 'london',
            'created_by' => 2,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 3,
            'first_name' => 'trainer',
            'last_name' => '3',
            'email' => 'trainer3@gmail.com',
            'phone_no' => 5666269548,
            'city' => 'london',
            'created_by' => 2,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '1',
            'email' => 'employ1@gmail.com',
            'phone_no' => 5446231548,
            'city' => 'london',
            'created_by' => 1,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '2',
            'email' => 'employ2@gmail.com',
            'phone_no' => 54462313338,
            'city' => 'london',
            'created_by' => 3,
            'password' => '00000000', // password
        ]);

        User::create([
            'role_id' => 4,
            'first_name' => 'employ',
            'last_name' => '3',
            'email' => 'employ3@gmail.com',
            'phone_no' => 54462111548,
            'city' => 'london',
            'created_by' => 3,
            'password' => '00000000', // password
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'saythub2024@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'gender' => 'male',
            'dob' => '2000-02-13',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

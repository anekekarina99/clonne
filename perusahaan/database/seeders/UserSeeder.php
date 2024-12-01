<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat user admin
        DB::table('users')->insert([
            'name' => 'Administrator',  // Nama admin
            'email' => 'admin@transisi.id',  // Email admin
            'password' => Hash::make('transisi'),  // Password admin, di-hash
            'role' => 'admin',  // Role admin
        ]);

        // Jika kamu ingin menambahkan user lain, misalnya user biasa:
        DB::table('users')->insert([
            'name' => 'User Example',  // Nama user
            'email' => 'user@transisi.id',  // Email user
            'password' => Hash::make('password123'),  // Password user, di-hash
            'role' => 'user',  // Role user
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Operator User',
                'email' => 'operator@example.com',
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tim Peneliti User',
                'email' => 'timpeneliti@example.com',
                'password' => Hash::make('password123'),
                'role' => 'tim peneliti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}

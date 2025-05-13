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
            'name' => 'Usuário Admin',
            'email' => 'admin@teste.com',
            'password' => Hash::make('senha123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

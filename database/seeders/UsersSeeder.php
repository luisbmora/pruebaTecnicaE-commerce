<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password1234'), // Cambia esto por una contraseña segura
        ]);

        User::create([
            'username' => 'testuser',
            'password' => Hash::make('password123'), // Cambia esto si lo necesitas
        ]);
    }
}

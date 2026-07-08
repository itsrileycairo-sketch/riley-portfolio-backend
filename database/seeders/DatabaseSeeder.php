<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Master Admin
        User::create([
            'name' => 'Nolan Fortino Ramadhany',
            'email' => 'nolan.fortino.ramadhany@gmail.com',
            'password' => Hash::make('rahasia123'), // Silakan ganti dengan password rahasia Kakak
        ]);
    }
}
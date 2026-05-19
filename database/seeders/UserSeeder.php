<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Campus',
            'email' => 'admin@campus.web.id',
            'password' => Hash::make('password123'), // Silakan ganti passwordnya
        ]);
    }
}
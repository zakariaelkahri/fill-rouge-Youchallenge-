<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Optional: Your own user
        User::create([
            'name' => 'zakaria',
            'email' => 'zakaria@gmail.com',
            'password' => Hash::make('Mimo20032016'),
            'email_verified_at' => now(),
        ]);

        // Create 2 organisers
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "Organisator $i",
                'email' => "organisator$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'remember_token' => Str::random(10),
            ]);
        }

        // Create 16 participants
        for ($i = 1; $i <= 16; $i++) {
            User::create([
                'name' => "Participant $i",
                'email' => "participant$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}

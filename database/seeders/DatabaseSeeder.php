<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder buat Admin (GKI)
        \App\Models\User::factory()->create([
            'name' => 'Admin GKI',
            'email' => 'admin@gkidelima.org',
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // Seeder buat User Biasa (GKI)
        \App\Models\User::factory()->create([
            'name' => 'User GKI',
            'email' => 'user@gkidelima.org',
            'role' => 'user',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);
    }
}

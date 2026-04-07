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
            'email' => 'nama@gkidelima.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);
    }
}

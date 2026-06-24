<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'nukman',
            'email' => 'admin@example.com',
            'role' => 'Leader',
            'team' => 'Tech',
            'password' => bcrypt('secret'),
        ]);

    }
}

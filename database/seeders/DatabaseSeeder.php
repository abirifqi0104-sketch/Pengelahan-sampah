<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@ecowaste.com'],
            [
                'name' => 'Admin EcoWaste',
                'email' => 'admin@ecowaste.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $this->call([
            CategorySeeder::class,
        ]);
    }
}


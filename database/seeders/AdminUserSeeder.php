<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'surname' => 'User',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'country' => 'GB',
                'gender' => 'male',
                'password' => Hash::make('password'),
                'profile_picture' => null,
            ]
        );
    }
}

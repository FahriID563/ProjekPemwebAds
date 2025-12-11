<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'full_name' => 'Administrator',
                'phone' => '081234567890',
                'email' => 'admin@warungkenyang.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'username' => 'pelayan1',
                'full_name' => 'Pelayan Satu',
                'phone' => '081234567891',
                'email' => 'pelayan1@warungkenyang.com',
                'role' => 'pelayan',
                'password' => Hash::make('password'),
            ],
            [
                'username' => 'customer1',
                'full_name' => 'Budi Santoso',
                'phone' => '081234567892',
                'email' => 'budi@email.com',
                'role' => 'customer',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['username' => $user['username']], $user);
        }
    }
}

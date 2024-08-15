<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'Admin Create',
                'email' => 'admincreate@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin_create',
            ],
            [
                'name' => 'Admin View',
                'email' => 'adminview@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin_view',
            ],
            [
                'name' => 'Sales',
                'email' => 'sales@example.com',
                'password' => Hash::make('password'),
                'role' => 'sales',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
            ]);
        }
    }
}

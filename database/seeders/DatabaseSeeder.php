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
        // User::factory(10)->create();
        $users = [
            [
                'name' => 'Faustino Vasquez',
                'email' => 'fvasquez@local.com',
            ],
            [
                'name' => 'Sebastian Vasquez',
                'email' => 'svasquez@local.com',
            ],
        ];

        $users = collect($users)->map(function ($user) {
            return User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt('password'), // Default password for all users
            ]);
        });

        // You can add more seeders here if needed
        // $this->call(AnotherSeeder::class);
    }
}

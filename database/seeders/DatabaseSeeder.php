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

        $categoryNumber = 1;
        foreach ($users as $user) {
            for ($j = 1; $j <= 5; $j++) {
                $user->categories()->create([
                    'name' => 'Categoría ' . $categoryNumber,
                    'description' => 'Descripción de la categoría ' . $categoryNumber,
                ]);
                $categoryNumber++;
            }
        }

        // Crear 10 grupos: 5 para el primer usuario y 5 para el segundo usuario
        $groupNumber = 1;
        foreach ($users as $user) {
            for ($i = 1; $i <= 5; $i++) {
                $user->groups()->create([
                    'name' => 'Grupo ' . $groupNumber,
                    'description' => 'Descripción del grupo ' . $groupNumber,
                ]);
                $groupNumber++;
            }
        }
    }
}

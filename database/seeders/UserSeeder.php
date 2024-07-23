<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création de l'admin
        User::create([
            'pseudo' => 'administrateur',
            'password' => Hash::make('Azerty88@'),
            'email' => 'admin@jp.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

                // Création d'un user de test
        User::create([
            'pseudo' => 'Utilisateur',
            'password' => Hash::make('Azerty88@'),
            'email' => 'user@jp.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);

        User::factory(8)->create();
    }
}

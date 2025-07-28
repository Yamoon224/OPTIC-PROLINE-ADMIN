<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a des entreprises pour lier les utilisateurs
        if (Company::count() === 0) {
            Company::factory(5)->create();
        }

        User::factory(50)->create();

        // Créer un utilisateur admin spécifique
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'company_id' => Company::first()->id,
        ]);
    }
}
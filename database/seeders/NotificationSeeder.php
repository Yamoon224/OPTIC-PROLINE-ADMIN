<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\{User, Company};

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a des utilisateurs et des entreprises pour les notifiables
        if (User::count() === 0) {
            Company::factory()->create(); // Crée une entreprise si nécessaire
            User::factory(5)->create();
        }
        if (Company::count() === 0) {
            Company::factory(5)->create();
        }

        Notification::factory(60)->create();
    }
}
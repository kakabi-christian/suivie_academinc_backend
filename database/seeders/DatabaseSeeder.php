<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Salle;
use App\Models\Ec;
use App\Models\Programmation;
use App\Models\Personnel;
use App\Models\Ue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Filiere::factory(200)->create();
        // Niveau::factory(500)->create();
        // Ue::factory(1000)->create();
        // Ec::factory(1000)->create();
        // Salle::factory(1000)->create();

        Personnel::factory(2500)->create();
        Programmation::factory(500)->create();
    }
}

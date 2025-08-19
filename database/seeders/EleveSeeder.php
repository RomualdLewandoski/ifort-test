<?php

namespace Database\Seeders;

use App\Models\Eleve;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EleveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        foreach (range(1, 20) as $i) {
            Eleve::create([
                'nomPrenom' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telephone' => $faker->phoneNumber,
                'dateInscription' => Carbon::now()->subDays(rand(0, 30)),
                'statutInscription' => $faker->randomElement([
                    'en_attente',
                    'validee',
                    'dossier_incomplet',
                    'annulee',
                ]),
                'estPrioritaire' => $faker->boolean(10),
            ]);
        }
    }
}

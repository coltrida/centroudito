<?php

namespace Database\Seeders;

use App\Models\Prova;
use Illuminate\Database\Seeder;
use function config;

class ProvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prova::insert([
            [
                'user_id' => 2,
                'client_id' => 4,
                'filiale_id' => 1,
                'tot' => 2400,
                'stato_id' => 4,
                'marketing_id' => 2,
                'inizio_prova' => '2021-05-19',
                'fine_prova' => '2021-05-19',
                'mese_inizio' => 5,
                'mese_fine' => 5,
                'anno_inizio' => 2021,
                'anno_fine' => 2021,
            ],
            [
                'user_id' => 2,
                'client_id' => 3,
                'filiale_id' => 1,
                'tot' => 4000,
                'stato_id' => 4,
                'marketing_id' => 2,
                'inizio_prova' => '2021-05-19',
                'fine_prova' => '2021-05-19',
                'mese_inizio' => 5,
                'mese_fine' => 5,
                'anno_inizio' => 2021,
                'anno_fine' => 2021,
            ],
            [
                'user_id' => 2,
                'client_id' => 3,
                'filiale_id' => 1,
                'tot' => 4000,
                'stato_id' => 4,
                'marketing_id' => 2,
                'inizio_prova' => '2021-04-19',
                'fine_prova' => '2021-04-19',
                'mese_inizio' => 4,
                'mese_fine' => 4,
                'anno_inizio' => 2021,
                'anno_fine' => 2021,
            ],
        ]);
    }
}

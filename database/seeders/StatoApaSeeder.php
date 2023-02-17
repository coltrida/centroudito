<?php

namespace Database\Seeders;

use App\Models\StatoApa;
use Illuminate\Database\Seeder;

class StatoApaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatoApa::insert([
            [
                'nome' => 'DDT'
            ],
            [
                'nome' => 'RESO'
            ],
            [
                'nome' => 'PROVA'
            ],
            [
                'nome' => 'FATTURA'
            ],
            [
                'nome' => 'FILIALE'
            ],
            [
                'nome' => 'RICHIESTO'
            ],
            [
                'nome' => 'NUOVO'
            ],
            [
                'nome' => 'IMMATRICOLATO'
            ],
        ]);
    }
}

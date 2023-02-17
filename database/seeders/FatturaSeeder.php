<?php

namespace Database\Seeders;

use App\Models\Fattura;
use Illuminate\Database\Seeder;

class FatturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fattura::insert([
            [
                'prova_id' => 1,
                'data_fattura' => '2021-05-19',
                'tot_fattura' => 2400,
            ],
            [
                'prova_id' => 2,
                'data_fattura' => '2021-05-19',
                'tot_fattura' => 4000,
            ],
            [
                'prova_id' => 3,
                'data_fattura' => '2021-04-19',
                'tot_fattura' => 4000,
            ],
        ]);
    }
}

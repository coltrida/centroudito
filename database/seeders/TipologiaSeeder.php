<?php

namespace Database\Seeders;

use App\Models\Tipologia;
use Illuminate\Database\Seeder;

class TipologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipologia::insert([
            [
                'nome' => 'PC',
                'recall' => 240
            ],
            [
                'nome' => 'CL',
                'recall' => null
            ],
            [
                'nome' => 'CLC',
                'recall' => null
            ],
            [
                'nome' => 'NORMO',
                'recall' => null
            ],

            [
                'nome' => 'DEC',
                'recall' => null
            ],
            [
                'nome' => 'LE',
                'recall' => null
            ],
        ]);
    }
}

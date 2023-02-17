<?php

namespace Database\Seeders;

use App\Models\Fornitore;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FornitoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fornitore::insert([
            [
                'nome' => Str::upper('Sonova Italia Srl'),
                'indirizzo' => Str::upper('Via Privata Raimondo Montecuccoli, 30'),
                'citta' => 'MILANO',
                'cap' => '20147',
                'provincia' => 'MI',
                'telefono' => '0269008182',
            ],
            [
                'nome' => Str::upper('Starkey Italy S.R.L.'),
                'indirizzo' => Str::upper('Via Lombardia, 2A'),
                'citta' => Str::upper('Peschiera Borromeo'),
                'cap' => '20068',
                'provincia' => 'MI',
                'telefono' => '029272181',
            ],
        ]);
    }
}

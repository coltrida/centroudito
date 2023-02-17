<?php

namespace Database\Seeders;

use App\Models\Materiale;
use Illuminate\Database\Seeder;

class MaterialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materiale::insert([
            [
                'nome' => 'CARTELLONE SCREENING',
                'codice' => 'MK110'
            ],
            [
                'nome' => 'CARTELLONE SCREENING PLASTIFICATO CON TASCA',
                'codice' => 'MK115'
            ],
            [
                'nome' => 'BROCHURE ISTITUZIONALE',
                'codice' => 'MK108'
            ],
            [
                'nome' => 'DISPLAY DA BANCO FORMATO A3',
                'codice' => 'MK116'
            ],
            [
                'nome' => 'BLOCK NOTES',
                'codice' => 'MK105'
            ],
            [
                'nome' => 'SHOPPER',
                'codice' => 'MK101'
            ],
        ]);
    }
}

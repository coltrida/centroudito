<?php

namespace Database\Seeders;

use App\Models\Filiale;
use Illuminate\Database\Seeder;

class FilialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filiale::insert([
            [
                'nome' => 'PISA',
                'indirizzo' => 'VIA MARIO LALLI 10',
                'citta' => 'PISA',
                'telefono' => '0506206057',
                'cap' => '56127',
                'provincia' => 'PI',
                'informazioni' => 'ACCANTO ALLA QUESTURA'
            ],
            [
                'nome' => 'CIVITANOVA',
                'indirizzo' => '........',
                'citta' => 'CIVITANOVA',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'MC',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'LUCCA',
                'indirizzo' => '........',
                'citta' => 'LUCCA',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'LU',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'ANCONA',
                'indirizzo' => '........',
                'citta' => 'ANCONA',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'AN',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'ASCOLI',
                'indirizzo' => '........',
                'citta' => 'ASCOLI',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'AP',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'VIAREGGIO',
                'indirizzo' => '........',
                'citta' => 'VIAREGGIO',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'LU',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'FIRENZE',
                'indirizzo' => '........',
                'citta' => 'FIRENZE',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'FI',
                'informazioni' => '..........'
            ],
            [
                'nome' => 'CORTONA',
                'indirizzo' => '........',
                'citta' => 'CORTONA',
                'telefono' => '........',
                'cap' => '........',
                'provincia' => 'AR',
                'informazioni' => '..........'
            ],
        ]);

        $filiali = Filiale::all();
        foreach ($filiali as $filiale){
            $filiale->codiceIdentificativo = 'F'.$filiale->id;
            $filiale->save();
        }
    }
}

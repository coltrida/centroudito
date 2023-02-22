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
                'indirizzo' => 'VIA ROMA 5',
                'citta' => 'CIVITANOVA',
                'telefono' => '0733666',
                'cap' => '68254',
                'provincia' => 'MC',
                'informazioni' => 'VICINO AL COMUNE'
            ],
            [
                'nome' => 'LUCCA',
                'indirizzo' => 'VIA PRINCIPALE 4',
                'citta' => 'LUCCA',
                'telefono' => '065484544',
                'cap' => '05225',
                'provincia' => 'LU',
                'informazioni' => 'NIENTE DI CHE'
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

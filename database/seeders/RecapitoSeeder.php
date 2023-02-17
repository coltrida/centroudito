<?php

namespace Database\Seeders;

use App\Models\Filiale;
use App\Models\Recapito;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idCosseddu = User::where('name', 'Federico Cosseddu')->first()->id;
        $idCaracciolo = User::where('name', 'Selene Caracciolo')->first()->id;
        $idSerra = User::where('name', 'Matteo Serra')->first()->id;
        $idAudioFirenze = User::where('name', 'Audio Firenze')->first()->id;
        $idFabietti = User::where('name', 'Carlo Fabietti')->first()->id;
        $idAmmToscana = User::where('name', 'Amm Toscana')->first()->id;
        $idAmmMarche = User::where('name', 'Amm Marche')->first()->id;
        $idCervone = User::where('name', 'Liliana Cervone')->first()->id;
        $idPapatheodoru = User::where('name', 'Athanasia Papatheodoru')->first()->id;
        $idAudioAscoli = User::where('name', 'Audio Ascoli')->first()->id;
        $idcall = User::where('name', 'call center')->first()->id;

        $idPisa = Filiale::where('nome', 'PISA')->first()->id;
        $idCivitanova = Filiale::where('nome', 'CIVITANOVA')->first()->id;
        $idLucca = Filiale::where('nome', 'LUCCA')->first()->id;
        $idAncona = Filiale::where('nome', 'ANCONA')->first()->id;
        $idAscoli = Filiale::where('nome', 'ASCOLI')->first()->id;
        $idViareggio = Filiale::where('nome', 'VIAREGGIO')->first()->id;
        $idFirenze = Filiale::where('nome', 'FIRENZE')->first()->id;

        Recapito::insert([
            [
                'nome' => 'IGEA SALUS',
                'indirizzo' => 'VIALE EUROPA 1',
                'citta' => 'LAMMARI',
                'provincia' => 'LU',
                'telefono' => '0583174896',
                'informazioni' => 'STUDI MEDICI, SOPRA LA FARMACIA COMUNALE',
                'user_id' => $idCosseddu,
                'filiale_id' => $idLucca,
                'codiceIdentificativo' => 'R1'
            ],
            [
                'nome' => 'OTTICA APPOLLONI',
                'indirizzo' => 'PIAZZA G. MATTEOTTI 168',
                'citta' => 'QUERCETA DI SERAVEZZA',
                'provincia' => 'LU',
                'telefono' => '0584760689',
                'informazioni' => "E' IN UNA TRAVERSA DELLA STRADA STATALE",
                'user_id' => $idCaracciolo,
                'filiale_id' => $idViareggio,
                'codiceIdentificativo' => 'R2'
            ],
            [
                'nome' => 'CENTRO MEDICO BLUGALLERY',
                'indirizzo' => 'VIA FERRANTE FERRANTI, 41',
                'citta' => 'TACCOLI',
                'provincia' => 'MC',
                'telefono' => '0733639051',
                'informazioni' => "AL PRIMO PIANO DELLO STABILE NELLA PIAZZA",
                'user_id' => $idPapatheodoru,
                'filiale_id' => $idCivitanova,
                'codiceIdentificativo' => 'R3'
            ],
            [
                'nome' => 'OTTICA OPTOCLINIC',
                'indirizzo' => 'PIAZZA DELLA FORNACE 14',
                'citta' => 'RIGLIONE',
                'provincia' => 'PI',
                'telefono' => '0505201164',
                'informazioni' => '...... ....... ........',
                'user_id' => $idCervone,
                'filiale_id' => $idPisa,
                'codiceIdentificativo' => 'R4'
            ],
            [
                'nome' => 'STUDI MEDICI LE QUERCIOLE',
                'indirizzo' => 'VIA DI CISANELLO, 1',
                'citta' => 'SAN GIIULIANO TERME',
                'provincia' => 'PI',
                'telefono' => '050879535',
                'informazioni' => '...... ....... ........',
                'user_id' => $idCosseddu,
                'filiale_id' => $idPisa,
                'codiceIdentificativo' => 'R5'
            ],
            [
                'nome' => 'FARMACIA COMUNALE LA FONTINA',
                'indirizzo' => 'VIA F. PONTECORVO, 3',
                'citta' => 'GHEZZANO',
                'provincia' => 'PI',
                'telefono' => '050878545',
                'informazioni' => '...... ....... ........',
                'user_id' => $idCervone,
                'filiale_id' => $idPisa,
                'codiceIdentificativo' => 'R6'
            ],
        ]);
    }
}

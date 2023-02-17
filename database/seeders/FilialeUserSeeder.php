<?php

namespace Database\Seeders;

use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilialeUserSeeder extends Seeder
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
        $idPaolini = User::where('name', 'Roberto Paolini')->first()->id;

        $idPisa = Filiale::where('nome', 'PISA')->first()->id;
        $idCivitanova = Filiale::where('nome', 'CIVITANOVA')->first()->id;
        $idLucca = Filiale::where('nome', 'LUCCA')->first()->id;
        $idAncona = Filiale::where('nome', 'ANCONA')->first()->id;
        $idAscoli = Filiale::where('nome', 'ASCOLI')->first()->id;
        $idViareggio = Filiale::where('nome', 'VIAREGGIO')->first()->id;
        $idFirenze = Filiale::where('nome', 'FIRENZE')->first()->id;
        $idCortona = Filiale::where('nome', 'CORTONA')->first()->id;

        FilialeUser::insert([
            [
                'filiale_id' => $idPisa,
                'user_id' => $idCosseddu,
            ],
            [
                'filiale_id' => $idLucca,
                'user_id' => $idCosseddu,
            ],
            [
                'filiale_id' => $idViareggio,
                'user_id' => $idCaracciolo,
            ],
            [
                'filiale_id' => $idFirenze,
                'user_id' => $idAudioFirenze,
            ],
             [
                 'filiale_id' => $idAncona,
                 'user_id' => $idFabietti,
             ],
             [
                 'filiale_id' => $idPisa,
                 'user_id' => $idAmmToscana,
             ],
            [
                'filiale_id' => $idLucca,
                'user_id' => $idAmmToscana,
            ],
             [
                 'filiale_id' => $idViareggio,
                 'user_id' => $idAmmToscana,
             ],
            [
                'filiale_id' => $idFirenze,
                'user_id' => $idAmmToscana,
            ],
            [
                'filiale_id' => $idCivitanova,
                'user_id' => $idAmmMarche,
            ],
            [
                'filiale_id' => $idAscoli,
                'user_id' => $idAmmMarche,
            ],
            [
                'filiale_id' => $idLucca,
                'user_id' => $idCervone,
            ],
            [
                'filiale_id' => $idPisa,
                'user_id' => $idCervone,
            ],
            [
                'filiale_id' => $idCivitanova,
                'user_id' => $idPapatheodoru,
            ],
            [
                'filiale_id' => $idAscoli,
                'user_id' => $idAudioAscoli,
            ],
            [
                'filiale_id' => $idCortona,
                'user_id' => $idPaolini,
            ],
/*            [
                'filiale_id' => $idPisa,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idCivitanova,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idLucca,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idMacerata,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idSanBenedetto,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idViareggio,
                'user_id' => $idcall,
            ],
            [
                'filiale_id' => $idFirenze,
                'user_id' => $idcall,
            ],*/
        ]);
    }
}

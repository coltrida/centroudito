<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Client;
use App\Models\Ddt;
use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\Fornitore;
use App\Models\Listino;
use App\Models\Marketing;
use App\Models\Product;
use App\Models\Recapito;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function config;
use function now;
use function rand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Filiale::insert([
            [
                'nome' => 'PISA',
                'indirizzo' => 'VIA ROSSI 23',
                'citta' => 'PISA',
                'telefono' => '0559583503',
                'cap' => '520226',
                'provincia' => 'PI',
            ],
            [
                'nome' => 'LUCCA',
                'indirizzo' => 'VIA VICOLO STRETTO 23',
                'citta' => 'GARFAGNANA DI BARGA',
                'telefono' => '08554545',
                'cap' => '584652',
                'provincia' => 'LU',
            ]
        ]);

        User::insert([
            [
                'name' => 'CACAO',
                'email' => 'cacao@cacao.it',
                'ruolo' => 'admin',
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Davide Coltrioli',
                'email' => 'audio@audio.it',
                'ruolo' => 'audio',
                'budget_id' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Cecchi Massimiliano',
                'email' => 'audio2@audio.it',
                'ruolo' => 'audio',
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'audio3',
                'email' => 'audio3@audio.it',
                'ruolo' => 'audio',
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'amministrativo',
                'email' => 'amm@amm.it',
                'ruolo' => 'segreteria',
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ]
        ]);



        Marketing::insert([
            [
                'name' => 'GIORNALE',
            ],
            [
                'name' => 'SCREENING',
            ],
            [
                'name' => 'LETTERA',
            ]
        ]);

        Fornitore::insert([
            [
                'nome' => 'PHONAK',
            ],
            [
                'nome' => 'STARKEY',
            ],
            [
                'nome' => 'OTICON',
            ]
        ]);

        Listino::insert([
            [
                'nome' => 'M90',
                'fornitore_id' => 1,
                'categoria' => 'APA',
                'costo' => 1000,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 4000,
                'iva' => 4
            ],
            [
                'nome' => 'M70',
                'fornitore_id' => 1,
                'categoria' => 'APA',
                'costo' => 800,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 3500,
                'iva' => 4
            ],
            [
                'nome' => 'SILVER',
                'fornitore_id' => 2,
                'categoria' => 'APA',
                'costo' => 300,
                'giorniTempoDiReso' => 120,
                'prezzolistino' => 1500,
                'iva' => 4
            ],
            [
                'nome' => 'GET',
                'fornitore_id' => 3,
                'categoria' => 'APA',
                'costo' => 150,
                'giorniTempoDiReso' => 60,
                'prezzolistino' => 1200,
                'iva' => 4
            ],
            [
                'nome' => 'TV LINK',
                'fornitore_id' => 2,
                'categoria' => 'ACC',
                'costo' => 200,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 400,
                'iva' => 22
            ]

        ]);

        Recapito::insert([
            [
                'nome' => 'FARMACIA ROSSI',
                'user_id' => 2,
            ],
            [
                'nome' => 'FARMACIA BIANCHI',
                'user_id' => 3,
            ],
            [
                'nome' => 'FARMACIA VERDI',
                'user_id' => 2,
            ]
        ]);

        FilialeUser::insert([
            [
                'filiale_id' => 1,
                'user_id' => 2,
            ],
            [
                'filiale_id' => 2,
                'user_id' => 2,
            ],
            [
                'filiale_id' => 2,
                'user_id' => 3,
            ],
            [
                'filiale_id' => 1,
                'user_id' => 4,
            ],
            [
                'filiale_id' => 1,
                'user_id' => 5,
            ],
            [
                'filiale_id' => 2,
                'user_id' => 5,
            ],
        ]);

        for ($i = 1; $i <5; $i++){
            Client::create([
                'nome' => 'CLIENTE'.$i,
                'cognome' => 'COGNOME'.$i,
                'codfisc' => Str::random(11),
                'indirizzo' => Str::upper(Str::random(20)),
                'cap' => rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'citta' => Str::upper(Str::random(10)),
                'provincia' => Str::upper(Str::random(2)),
                'telefono' => '321615612',
                'tipo' => Arr::random(['PC', 'CL', 'CLC']),
                'fonte' => Arr::random(['LETTERA', 'SCREENING', 'GIORNALE']),
                'user_id' => rand(2,3),
                'filiale_id' => rand(1,2),
            ]);
        }

        Budget::create([
            'budgetAnno' => 100000,
            'stipendio' => 1000,
            'provvigione' => 10,
            'gennaio' => 8,
            'febbraio' => 10,
            'marzo' => 8,
            'aprile' => 10,
            'maggio' => 8,
            'giugno' => 8,
            'luglio' => 8,
            'agosto' => 8,
            'settembre' => 8,
            'ottobre' => 8,
            'novembre' => 8,
            'dicembre' => 8,
        ]);

        Product::insert([
            [
                'matricola' => '123',
                'stato' => config('enum.statoAPA.ddt'),
                'filiale_id' => 2,
                'listino_id' => 4,
                'fornitore_id' => 3,
                'ddt_id' => 1
            ],
            [
                'matricola' => '234',
                'stato' => config('enum.statoAPA.ddt'),
                'filiale_id' => 2,
                'listino_id' => 4,
                'fornitore_id' => 3,
                'ddt_id' => 1
            ],
            [
                'matricola' => '456',
                'stato' => config('enum.statoAPA.ddt'),
                'filiale_id' => 2,
                'listino_id' => 4,
                'fornitore_id' => 3,
                'ddt_id' => 1
            ],
            [
                'matricola' => '567',
                'stato' => config('enum.statoAPA.ddt'),
                'filiale_id' => 2,
                'listino_id' => 4,
                'fornitore_id' => 3,
                'ddt_id' => 1
            ],
        ]);

        Ddt::insert([
            'filiale_id' => 2,
            'nome_destinazione' => 'CENTRO UDITO LUCCA',
            'indirizzo_destinazione' => 'VIA VICOLO STRETTO 23',
            'citta_destinazione' => 'GARFAGNANA DI BARGA',
            'cap_destinazione' => 584652,
            'provincia_destinazione' => 'LU',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

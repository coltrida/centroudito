<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Filiale;
use App\Models\Marketing;
use App\Models\Recapito;
use App\Models\User;
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
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Davide Coltrioli',
                'email' => 'audio@audio.it',
                'ruolo' => 'audio',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Cecchi Massimiliano',
                'email' => 'audio2@audio.it',
                'ruolo' => 'audio',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'audio3',
                'email' => 'audio3@audio.it',
                'ruolo' => 'audio',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'amministrativo',
                'email' => 'amministrativo@amministrativo.it',
                'ruolo' => 'segreteria',
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

        Recapito::insert([
            [
                'nome' => 'FARMACIA ROSSI',
            ],
            [
                'nome' => 'FARMACIA BIANCHI',
            ],
            [
                'nome' => 'FARMACIA VERDI',
            ]
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
    }
}

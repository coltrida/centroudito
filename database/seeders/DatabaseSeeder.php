<?php

namespace Database\Seeders;

use App\Models\Client;
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
        User::insert([
            [
                'name' => 'cacao',
                'email' => 'cacao@cacao.it',
                'ruolo' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'audio',
                'email' => 'audio@audio.it',
                'ruolo' => 'audio',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'audio2',
                'email' => 'audio2@audio.it',
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

/*        for ($i = 1; $i <50000; $i++){
            Client::create([
                'name' => 'cliente'.$i,
                'codfisc' => Str::random(11),
                'indirizzo' => Str::random(20),
                'cap' => rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'citta' => Str::random(10),
                'provincia' => Str::random(2),
                'telefono' => '321615612',
                'tipo' => Arr::random(['pc', 'cl', 'clc']),
                'fonte' => Arr::random(['Farmacia Rossi', 'Farmacia Bianchi', 'Farmacia Verdi', 'giornale', 'telefonata']),
                'user_id' => rand(2,3)
            ]);
        }*/
    }
}

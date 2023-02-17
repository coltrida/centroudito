<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function rand;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Client::create([
            'nome' => 'MASSIMO',
            'cognome' => 'TRAINITI',
            'indirizzo' => 'VIA TEVERE 29',
            'citta' => 'SAN GIULIANO TERME',
            'provincia' => 'PI',
            'telefono' => '321615612',
            'user_id' => 2,
            'tipologia_id' => 6,
            'filiale_id' => 1,
            'marketing_id' => 4,
            'mese' => 11,
            'anno' => 2021,
        ]);

        for ($i = 1; $i < 3000; $i++){
            Client::create([
                'nome' => 'CLIENTE'.$i.'21',
                'cognome' => 'COGNOME'.$i.'21',
                'codfisc' => Str::random(11),
                'indirizzo' => Str::upper(Str::random(20)),
                'cap' => rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'citta' => Str::upper(Str::random(10)),
                'provincia' => Str::upper(Str::random(2)),
                'telefono' => '321615612',
                'tipologia_id' => 6,
                'marketing_id' => rand(1,3),
                'user_id' => 2,
                'filiale_id' => 1,
                'mese' => Carbon::now()->subMonths(rand(0,5))->month,
                'anno' => Carbon::now()->year,
                'recapito_id' => rand(1,2)
            ]);
        }

/*        for ($i = 1; $i < 2000; $i++){
            Client::create([
                'nome' => 'CLIENTE'.$i.'22',
                'cognome' => 'COGNOME'.$i.'22',
                'codfisc' => Str::random(11),
                'indirizzo' => Str::upper(Str::random(20)),
                'cap' => rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'citta' => Str::upper(Str::random(10)),
                'provincia' => Str::upper(Str::random(2)),
                'telefono' => '321615612',
                'tipologia_id' => 6,
                'marketing_id' => rand(1,3),
                'user_id' => 6,
                'filiale_id' => 2,
                'mese' => Carbon::now()->subMonths(rand(0,5))->month,
                'anno' => Carbon::now()->year,
                'recapito_id' => rand(1,2)
            ]);
        }

        for ($i = 1; $i < 2000; $i++){
            Client::create([
                'nome' => 'CLIENTE'.$i.'23',
                'cognome' => 'COGNOME'.$i.'23',
                'codfisc' => Str::random(11),
                'indirizzo' => Str::upper(Str::random(20)),
                'cap' => rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'citta' => Str::upper(Str::random(10)),
                'provincia' => Str::upper(Str::random(2)),
                'telefono' => '321615612',
                'tipologia_id' => 6,
                'marketing_id' => rand(1,3),
                'user_id' => 2,
                'filiale_id' => 3,
                'mese' => Carbon::now()->subMonths(rand(0,5))->month,
                'anno' => Carbon::now()->year,
                'recapito_id' => rand(1,2)
            ]);
        }*/
    }
}

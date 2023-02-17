<?php

namespace Database\Seeders;

use App\Models\Appuntamento;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppuntamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $giorno = Carbon::now()->format('Y-m-d');
        $numeroGiorno = Carbon::now()->dayOfWeek;
        $domani = $numeroGiorno == 5 ? Carbon::now()->addDays(3)->format('Y-m-d') : Carbon::now()->addDay()->format('Y-m-d');

        Appuntamento::insert([
            [
                'giorno' => $giorno,
                'orario' => rand(9,18).':00:00',
                'tipo' => 'Prima Visita',
                'user_id' => 2,
                'client_id' => 1,
                'preso_id' => 10,
                'filiale_id' => 1,
                'created_at' => Carbon::now(),
                'mese' => Carbon::now()->month,
                'anno' => Carbon::now()->year,
            ],
/*            [
                'giorno' => $giorno,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'giorno' => $giorno,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'giorno' => $giorno,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'giorno' => $domani,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'giorno' => $domani,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],
            [
                'giorno' => $domani,
                'orario' => rand(9,18).':00:00',
                'user_id' => 5,
                'client_id' => User::find(5)->client->random()->id,
                'filiale_id' => 3,
                'created_at' => Carbon::now()
            ],*/
        ]);
    }
}

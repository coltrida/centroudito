<?php

namespace Database\Seeders;

use App\Models\Telefonata;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TelefonateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Telefonata::insert([
            [
                'datarecall' => Carbon::now()->subDay()->format('Y-m-d'),
                'mese' => Carbon::now()->subDay()->month,
                'anno' => Carbon::now()->subDay()->year,
                'user_id' => 2,
                'eseguita_id' => 10,
                'client_id' => 1,
                'esito' => 'Preso Appuntamento',
                'effettuata' => 1,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
        ]);
    }
}

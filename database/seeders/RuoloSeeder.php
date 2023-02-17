<?php

namespace Database\Seeders;

use App\Models\Ruolo;
use Illuminate\Database\Seeder;

class RuoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruolo::insert([
            [
                'nome' => 'admin'
            ],
            [
                'nome' => 'audio'
            ],
            [
                'nome' => 'amministrazione'
            ],
            [
                'nome' => 'call'
            ],
        ]);
    }
}

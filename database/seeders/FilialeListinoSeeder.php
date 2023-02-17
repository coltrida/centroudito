<?php

namespace Database\Seeders;

use App\Models\Filiale;
use App\Models\Listino;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FilialeListinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filiale::all()->each(function ($filiale){
            Listino::all()->each(function ($listino) use($filiale){
                $filiale->listino()->attach($listino->id, ['soglia' => Arr::random([1])]);
            });
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Listino;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Listino::insert([
            [
                'nome' => 'AUDEO M90',
                'fornitore_id' => 1,
                'categoria_id' => 1,
                'costo' => 945,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 4200,
                'scontoMax' => 10,
                'iva' => 4
            ],
            [
                'nome' => 'AUDEO M70',
                'fornitore_id' => 1,
                'categoria_id' => 1,
                'costo' => 708,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 3200,
                'scontoMax' => 10,
                'iva' => 4
            ],
            [
                'nome' => 'AUDEO M50',
                'fornitore_id' => 1,
                'categoria_id' => 1,
                'costo' => 573,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2400,
                'scontoMax' => 10,
                'iva' => 4
            ],
            [
                'nome' => 'AUDEO M30',
                'fornitore_id' => 1,
                'categoria_id' => 1,
                'costo' => 445,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 1700,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio 2400 AI'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 664,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2800,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio 2000 AI'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 469,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2500,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio 1600 AI'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 359,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2200,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio 1200 AI'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 265,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 1700,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio 2400 EDGE AI Lithium'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 729,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 3200,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio AI 2000 Lithium'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 509,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2600,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio AI 1600 Lithium'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 399,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 2300,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Livio AI 1200 Lithium'),
                'fornitore_id' => 2,
                'categoria_id' => 1,
                'costo' => 306,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 1800,
                'scontoMax' => 0,
                'iva' => 4
            ],
            [
                'nome' => Str::upper('Charger Phonak'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 53,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 55,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('Charger Starkey'),
                'fornitore_id' => 2,
                'categoria_id' => 2,
                'costo' => 53,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 55,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('RemoteControl'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 150,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 170,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('Ricevitore esterno'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 35,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 36,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('Paracerume CeruShield'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 2.5,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 3,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('Paracerume Nowax'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 13,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 15,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('TVLINK CONNECTOR'),
                'fornitore_id' => 1,
                'categoria_id' => 2,
                'costo' => 70,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 100,
                'scontoMax' => 0,
                'iva' => 22
            ],
            [
                'nome' => Str::upper('Garanzia 3* anno'),
                'fornitore_id' => 1,
                'categoria_id' => 3,
                'costo' => 60,
                'giorniTempoDiReso' => 90,
                'prezzolistino' => 70,
                'scontoMax' => 0,
                'iva' => 22
            ],
        ]);

        $listino = Listino::whereHas('categoria', function ($q){
            $q->where('nome', 'APA');
        })
            ->orderBy('fornitore_id')
            ->orderBy('categoria_id')
            ->orderBy('nome')
            ->get();

        $type = 'string';
        foreach ($listino as $ele){
            Schema::table('ventaglios', function (Blueprint $table) use ($type, $ele) {
                $table->$type(str_replace(' ', '', $ele->nome))->default(0);
            });
        }

    }
}

<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Fattura;
use Carbon\Carbon;
use function dd;

class FatturaService
{
    public function crea($request)
    {
        $fattura = new Fattura();
        $fattura->prova_id = $request['prova']['id'];
        $fattura->data_fattura = Carbon::now();
        $fattura->acconto = (int)$request['acconto'];
        $fattura->nr_rate = (int)$request['rate'];
        $fattura->tot_fattura = (int)$request['totFattura'];
        $fattura->al_saldo = (int)$request['totFattura'] - (int)$request['acconto'];
        $res = $fattura->save();

        foreach ($request['prova']['product'] as $prodotto){
            $prodotto->fattura_id = $fattura->id;
            $prodotto->save();
        }

        return $res;
    }

    public function listaFattureFromClient($id)
    {
        return Client::with(['provaFattura' => function($q){
            $q->with(['fattura', 'product' => function($z){
                $z->with('listino');
            }]);
        }])->find($id)->provaFattura;
    }
}

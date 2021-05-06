<?php


namespace App\Services;


use App\Models\Fattura;
use App\Models\Product;
use App\Models\ProductProva;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function config;
use function dd;
use function trim;

class ProvaService
{

    public function inserisci($request)
    {
        //dd($request);
        $prova = new Prova();

        $prova->inizio_prova = Carbon::now();
        $prova->mese_inizio = Carbon::now()->month;
        $prova->anno_inizio = Carbon::now()->year;
        $prova->client_id = $request['client_id'];
        $prova->filiale_id = $request['filiale_id'];
        $prova->user_id = $request['user_id'];
        $prova->stato = $request['stato'];
        $prova->tot = $request['tot'];
        $prova->created_at = Carbon::now();
        $prova->save();
        foreach ($request['prodotti'] as $prodotti){
            //dd($prodotti);
            $productProva = new ProductProva();
            $productProva->prova_id = $prova->id;
            $productProva->product_id = $prodotti['id'];
            $productProva->prezzo = $prodotti['prezzoProposto'];
            $productProva->orecchio = $prodotti['orecchio'];
            $productProva->save();

            $prodotto = Product::find($prodotti['id']);
            $prodotto->stato = config('enum.statoAPA.prova');
            $prodotto->user_id = $request['user_id'];
            $prodotto->client_id = $request['client_id'];
            $prodotto->save();
        }
        //dd($request['prodotti']);
    }

    public function rimuovi($id)
    {
        $oggi = Carbon::now();
        $prova = Prova::with('product')->find($id);
        $prova->stato = config('enum.statoAPA.reso');
        $prova->fine_prova = $oggi->format('Y-m-d');
        $prova->mese_fine = $oggi->month;
        $prova->anno_fine = $oggi->year;
        foreach ($prova->product as $prodotto){
            $prodotto->stato = config('enum.statoAPA.filiale');
            $prodotto->user_id = null;
            $prodotto->client_id = null;
            $prodotto->save();
        }
        return $prova->save();
    }

    public function fattura($id)
    {
        $oggi = Carbon::now();
        $prova = Prova::with('product')->find($id);
        $prova->fine_prova = $oggi->format('Y-m-d');
        $prova->stato = config('enum.statoAPA.fattura');
        $prova->mese_fine = $oggi->month;
        $prova->anno_fine = $oggi->year;
        foreach ($prova->product as $prodotto){
            $prodotto->stato = config('enum.statoAPA.fattura');
            $prodotto->save();
        }
        return $prova->save();
    }

    public function infoprova($id)
    {
        return Prova::with(['client', 'product' => function($q){
            $q->with('listino');
        }])->find($id);
    }
}

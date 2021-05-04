<?php


namespace App\Services;


use App\Models\ProductProva;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
            $productProva->save();
        }
        //dd($request['prodotti']);
    }

    public function rimuovi($id)
    {
        return Prova::find($id)->delete();
    }
}

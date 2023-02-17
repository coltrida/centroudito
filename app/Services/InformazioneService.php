<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Informazione;
use Illuminate\Support\Str;
use function trim;

class InformazioneService
{
    public function lista($id)
    {
        return Client::with(['informazione' => function($q){
            $q->latest();
        }])->find($id)->informazione;
    }

    public function aggiungi($request)
    {
        $client = Client::with('appuntamentisospesi')->find($request->client_id);
        foreach($client->appuntamentisospesi as $appuntmento){
            $appuntmento->intervenuto = true;
            $appuntmento->save();
        }
        return Informazione::create([
            'client_id' => $request->client_id,
            'giorno' => $request->giorno,
            'tipo' => trim(Str::upper($request->tipo)),
            'note' => trim(Str::upper($request->note)),
        ]);
    }

}

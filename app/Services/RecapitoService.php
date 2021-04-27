<?php


namespace App\Services;


use App\Models\Recapito;

class RecapitoService
{
    public function recapiti()
    {
        return Recapito::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Recapito::insert([
            'nome' => $request['nome'],
            'indirizzo' => $request['indirizzo'],
            'citta' => $request['citta'],
            'provincia' => $request['provincia']
        ]);
    }

    public function rimuovi($id)
    {
        return Recapito::find($id)->delete();
    }
}

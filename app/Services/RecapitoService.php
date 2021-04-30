<?php


namespace App\Services;


use App\Models\Recapito;
use App\Models\User;
use Illuminate\Support\Str;

class RecapitoService
{
    public function recapiti()
    {
        return Recapito::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Recapito::insert([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'provincia' => trim(Str::upper($request['provincia']))
        ]);
    }

    public function rimuovi($id)
    {
        return Recapito::find($id)->delete();
    }
}

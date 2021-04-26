<?php


namespace App\Services;


use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function trim;

class ClientService
{
    public function index($idAudio)
    {

    }

    public function inserisci($request)
    {
        return Client::insert([
            'name' =>  trim(Str::upper($request->cognome)).' '.trim(Str::upper($request->nome)),
            'codfisc' => trim(Str::upper($request->codfisc)) == '' ? null : trim(Str::upper($request->codfisc)),
            'indirizzo' => trim(Str::upper($request->indirizzo)),
            'citta' => trim(Str::upper($request->citta)),
            'cap' => trim(Str::upper($request->cap)),
            'provincia' => trim(Str::upper($request->provincia)),
            'telefono' => trim(Str::upper($request->telefono)),
            'user_id' => Auth::id(),
            'fonte' => trim(Str::upper($request->fonte)),
            'mail' => trim(Str::upper($request->mail)),
            'tipo' => trim(Str::upper($request->tipo))
        ]);
    }
}

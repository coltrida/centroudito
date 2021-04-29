<?php


namespace App\Services;


use App\Models\Fornitore;
use Illuminate\Support\Str;

class FornitoreService
{
    public function fornitori()
    {
        return Fornitore::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Fornitore::insert([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'telefono' => $request['telefono'],
            'cap' => $request['cap'],
            'email' => trim(Str::upper($request['email'])),
            'pec' => trim(Str::upper($request['pec'])),
            'univoco' => trim(Str::upper($request['codunivoco'])),
            'provincia' => trim(Str::upper($request['provincia'])),
        ]);
    }

    public function rimuovi($id)
    {
        return Fornitore::find($id)->delete();
    }
}

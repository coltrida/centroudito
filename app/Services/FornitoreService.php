<?php


namespace App\Services;


use App\Models\Fornitore;

class FornitoreService
{
    public function fornitori()
    {
        return Fornitore::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Fornitore::insert([
            'nome' => $request['nome'],
            'indirizzo' => $request['indirizzo'],
            'citta' => $request['citta'],
            'telefono' => $request['telefono'],
            'cap' => $request['cap'],
            'email' => $request['email'],
            'pec' => $request['pec'],
            'univoco' => $request['codunivoco'],
            'provincia' => $request['provincia'],
        ]);
    }

    public function rimuovi($id)
    {
        return Fornitore::find($id)->delete();
    }
}

<?php


namespace App\Services;


use App\Models\Filiale;

class FilialeService
{
    public function filiali()
    {
        return Filiale::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Filiale::insert([
            'nome' => $request['nome'],
            'indirizzo' => $request['indirizzo'],
            'citta' => $request['citta'],
            'telefono' => $request['telefono'],
            'cap' => $request['cap'],
            'provincia' => $request['provincia']
        ]);
    }

    public function rimuovi($id)
    {
        return Filiale::find($id)->delete();
    }
}

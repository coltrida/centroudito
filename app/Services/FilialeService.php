<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\FilialeUser;
use Illuminate\Support\Str;
use function dd;

class FilialeService
{
    public function filiali()
    {
        return Filiale::with('users')->orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Filiale::insert([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'telefono' => trim(Str::upper($request['telefono'])),
            'cap' => $request['cap'],
            'provincia' => trim(Str::upper($request['provincia']))
        ]);
    }

    public function rimuovi($id)
    {
        return Filiale::find($id)->delete();
    }

    public function associa($filialeId, $personale)
    {
        $filiale = Filiale::find($filialeId);
        $filiale->users()->attach($personale);
    }

    public function dissocia($id)
    {
        FilialeUser::find($id)->delete();
    }

}

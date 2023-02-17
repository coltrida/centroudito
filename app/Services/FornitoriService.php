<?php


namespace App\Services;


use App\Models\Fornitore;
use Illuminate\Support\Str;
use function trim;

class FornitoriService
{
    public function fornitori()
    {
        return Fornitore::orderBy('nome')->get();
    }

    public function addFornitore($request)
    {
        return Fornitore::create([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'telefono' => $request['telefono'],
            'cap' => $request['cap'],
            'email' => trim(Str::upper($request['email'])),
            'pec' => trim(Str::upper($request['pec'])),
            'univoco' => trim(Str::upper($request['univoco'])),
            'provincia' => trim(Str::upper($request['provincia'])),
        ]);
        /*$fornitore = new Fornitore();

        $fornitore->nome = trim(Str::upper($request['nome']));
        $fornitore->indirizzo = trim(Str::upper($request['indirizzo']));
        $fornitore->citta = trim(Str::upper($request['citta']));
        $fornitore->telefono = $request['telefono'];
        $fornitore->cap = $request['cap'];
        $fornitore->email = trim(Str::upper($request['email']));
        $fornitore->pec = trim(Str::upper($request['pec']));
        $fornitore->univoco = trim(Str::upper($request['codunivoco']));
        $fornitore->provincia = trim(Str::upper($request['provincia']));
        $fornitore->save();
        return $fornitore;*/
    }

    public function eliminaFornitore($id)
    {
        return Fornitore::find($id)->delete();
    }

    public function modificaFornitore($request)
    {
        $fornitore = Fornitore::find($request->id);

        $fornitore->nome = trim(Str::upper($request['nome']));
        $fornitore->indirizzo = trim(Str::upper($request['indirizzo']));
        $fornitore->citta = trim(Str::upper($request['citta']));
        $fornitore->telefono = $request['telefono'];
        $fornitore->cap = $request['cap'];
        $fornitore->email = trim(Str::upper($request['email']));
        $fornitore->pec = trim(Str::upper($request['pec']));
        $fornitore->univoco = trim(Str::upper($request['codunivoco']));
        $fornitore->provincia = trim(Str::upper($request['provincia']));
        $fornitore->save();
        return $fornitore;
    }
}

<?php


namespace App\Services;


use App\Models\Materiale;

class MaterialeService
{
    public function lista()
    {
        return Materiale::orderBy('nome')->get();
    }

    public function aggiungi($request)
    {
        return Materiale::create([
            'nome' => $request->nome,
            'codice' => $request->codice,
        ]);
    }

    public function modifica($request)
    {
        $materiale = Materiale::find($request->id);
        $materiale->nome = $request->nome;
        $materiale->codice = $request->codice;
        $materiale->save();
        return $materiale;
    }

    public function elimina($id)
    {
        Materiale::destroy($id);
    }
}

<?php


namespace App\Services;


use App\Models\Tipologia;
use Illuminate\Support\Str;
use function trim;

class TipologiaService
{
    public function lista()
    {
        return Tipologia::orderBy('nome')->get();
    }

    public function modifica($request)
    {
        $new = Tipologia::find($request->id);
        $new->nome = trim(Str::upper($request->nome));
        $new->recall = $request->recall;
        $new->save();
        return Tipologia::orderBy('nome')->get();
    }

    public function aggiungi($request)
    {
        return Tipologia::create([
            'nome' => trim(Str::upper($request->nome)),
            'recall' => $request->recall,
        ]);

        /*$new = new Tipologia();
        $new->nome = trim(Str::upper($request->nome));
        $new->recall = $request->recall;
        $new->save();
        return $new;*/
    }

    public function elimina($id)
    {
        return Tipologia::find($id)->delete();
    }
}

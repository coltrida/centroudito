<?php


namespace App\Services;


use App\Models\Ruolo;
use Illuminate\Support\Str;
use function trim;

class RuoloService
{
    public function lista()
    {
        return Ruolo::where('nome', '!=', 'admin')->orderBy('nome')->get();
    }

    public function aggiungi($request)
    {
        return Ruolo::create([
            'nome' => trim(Str::upper($request->nome))
        ]);
        /*$new = new Ruolo();
        $new->nome = trim(Str::upper($request->nome));
        $new->save();
        return $new;*/
    }

    public function elimina($id)
    {
        return Ruolo::find($id)->delete();
    }
}

<?php


namespace App\Services;


use App\Models\Categoria;
use Illuminate\Support\Str;
use function trim;

class CategoriaService
{
    public function lista()
    {
        return Categoria::orderBy('nome')->get();
    }

    public function aggiungi($request)
    {
        $new = new Categoria();
        $new->nome = trim(Str::upper($request->nome));
        $new->save();
        return $new;
    }

    public function elimina($id)
    {
        return Categoria::find($id)->delete();
    }
}

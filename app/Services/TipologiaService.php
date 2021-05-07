<?php


namespace App\Services;


use App\Models\Tipologia;

class TipologiaService
{
    public function tipologie()
    {
        return Tipologia::get();
    }

    public function associaTempi($id, $giorni)
    {
        $tipo = Tipologia::find($id);
        $tipo->recall = $giorni;
        $tipo->save();
    }

    public function crea($nome, $tempistica)
    {
        Tipologia::insert([
            'nome' => $nome,
            'recall' => $tempistica
        ]);
    }

    public function rimuovi($id)
    {
        Tipologia::find($id)->delete();
    }
}

<?php


namespace App\Services;


use App\Models\Listino;
use Illuminate\Support\Str;

class ListinoService
{
    public function listino($ricerca='')
    {
        if($ricerca == ''){
            return Listino::orderBy('fornitore_id')->orderBy('categoria')->get();
        } else {
            return Listino::where('nome', 'like', '%'.$ricerca.'%')->get();
        }

    }

    public function inserisci($request)
    {
        return Listino::insert([
            'categoria' => trim(Str::upper($request['categoria'])),
            'nome' => trim(Str::upper($request['nome'])),
            'costo' => trim($request['costo']),
            'giorniTempoDiReso' => trim($request['giorniDiReso']),
            'fornitore_id' => $request['fornitore_id'],
            'prezzolistino' => trim($request['prezzolistino']),
            'iva' => trim($request['iva']),
        ]);
    }

    public function rimuovi($id)
    {
        return Listino::find($id)->delete();
    }
}

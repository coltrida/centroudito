<?php


namespace App\Services;


use App\Models\Listino;

class ListinoService
{
    public function listino($ricerca)
    {
        if($ricerca == ''){
            return Listino::orderBy('categoria')->get();
        } else {
            return Listino::where('nome', 'like', '%'.$ricerca.'%')->get();
        }

    }

    public function inserisci($request)
    {
        return Listino::insert([
            'categoria' => $request['categoria'],
            'nome' => $request['nome'],
            'costo' => $request['costo'],
            'fornitore_id' => $request['fornitore_id'],
            'prezzolistino' => $request['prezzolistino'],
            'iva' => $request['iva'],
        ]);
    }

    public function rimuovi($id)
    {
        return Listino::find($id)->delete();
    }
}

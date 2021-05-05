<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\Fornitore;
use Illuminate\Support\Str;
use function dd;

class FornitoreService
{
    public function fornitori()
    {
        return Fornitore::orderBy('nome')->get();
    }

    public function inserisci($request)
    {
        return Fornitore::insert([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'telefono' => $request['telefono'],
            'cap' => $request['cap'],
            'email' => trim(Str::upper($request['email'])),
            'pec' => trim(Str::upper($request['pec'])),
            'univoco' => trim(Str::upper($request['codunivoco'])),
            'provincia' => trim(Str::upper($request['provincia'])),
        ]);
    }

    public function rimuovi($id)
    {
        return Fornitore::find($id)->delete();
    }

    public function listinoFromFornitore($id)
    {
        return $id ? Fornitore::with('listino')->find($id)->listino : '';
    }

    public function productFromFornitore($id)
    {
        return $id ? Fornitore::with('product')->find($id)->product : '';
    }

    public function productFromFornitoreInFiliale($idFornitore, $idFiliale)
    {
        /*dd(Filiale::with(['products' => function ($q) use($idFornitore) {
            $q->with(['filiale', 'fornitore', 'listino'])->whereHas('fornitore', function($z) use($idFornitore) {
                $z->where('id', $idFornitore);
            })->where('stato', 'FILIALE');
        }])->find($idFiliale)->products);*/

        return Filiale::with(['products' => function ($q) use($idFornitore) {
            $q->with(['filiale', 'fornitore', 'listino'])->whereHas('fornitore', function($z) use($idFornitore) {
                $z->where('id', $idFornitore);
            })->where('stato', 'FILIALE');
        }])->find($idFiliale) ? Filiale::with(['products' => function ($q) use($idFornitore) {
            $q->with(['filiale', 'fornitore', 'listino'])->whereHas('fornitore', function($z) use($idFornitore) {
                $z->where('id', $idFornitore);
            })->where('stato', 'FILIALE');
        }])->find($idFiliale)->products : [];
    }
}

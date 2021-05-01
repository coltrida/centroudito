<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\Product;
use Illuminate\Support\Str;
use function dd;
use function trim;

class ProductService
{
    public function products($idFiliale, $ricerca)
    {
        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->orderBy('fornitore_id')->orderBy('listino_id');
            }])->find($idFiliale)->products;

            //return Product::orderBy('fornitore_id')->orderBy('listino_id')->get();
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->where('nome', 'like', '%'.$ricerca.'%');
            }])->find($idFiliale)->products;

            /*return Product::whereHas('listino', function($q) use($ricerca){
                $q->where('nome', 'like', '%'.$ricerca.'%');
            })->get();*/
        }
    }

    public function inserisci($request)
    {
        return Product::insert([
            'matricola' => trim($request['matricola']),
            'stato' => trim(Str::upper($request['stato'])),
            'fornitore_id' => $request['fornitore_id'],
            'filiale_id' => $request['filiale_id'],
            'listino_id' => $request['listino_id'],
        ]);
    }

    public function rimuovi($id)
    {
        return Product::find($id)->delete();
    }

}

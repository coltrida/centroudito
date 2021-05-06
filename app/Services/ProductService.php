<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function config;
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

        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->where('nome', 'like', '%'.$ricerca.'%');
            }])->find($idFiliale)->products;
        }
    }

    public function prodottiInFiliale($idFiliale, $ricerca)
    {
        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->where('stato', 'FILIALE')->orderBy('fornitore_id')->orderBy('listino_id');
            }])->find($idFiliale)->products;
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->whereHas('listino', function($z) use($ricerca){
                    $z->where('nome', 'like', '%'.$ricerca.'%');
                })->where('stato', config('enum.statoAPA.filiale'))->orWhere([['matricola', 'like', '%'.$ricerca.'%'], ['stato', config('enum.statoAPA.filiale')]]);
            }])->find($idFiliale)->products;
        }
    }

    public function prodottiInArrivo($idFiliale, $ricerca)
    {
        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->where('stato', config('enum.statoAPA.ddt'))->orderBy('fornitore_id')->orderBy('listino_id');
            }])->find($idFiliale)->products;
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->whereHas('listino', function($z) use($ricerca){
                    $z->where('nome', 'like', '%'.$ricerca.'%');
                })->where('stato', config('enum.statoAPA.ddt'))->orWhere([['matricola', 'like', '%'.$ricerca.'%'], ['stato', config('enum.statoAPA.ddt')]]);
            }])->find($idFiliale)->products;
        }
    }

    public function prodottiInProva($idFiliale, $ricerca)
    {
        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->where('stato', config('enum.statoAPA.prova'))->orderBy('fornitore_id')->orderBy('listino_id');
            }])->find($idFiliale)->products;
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->whereHas('listino', function($z) use($ricerca){
                    $z->where('nome', 'like', '%'.$ricerca.'%');
                })->where('stato', config('enum.statoAPA.ddt'))->orWhere([['matricola', 'like', '%'.$ricerca.'%'], ['stato', config('enum.statoAPA.prova')]]);
            }])->find($idFiliale)->products;
        }
    }

    public function prodottiRichiesti($idFiliale, $ricerca)
    {
        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->where('stato', config('enum.statoAPA.richiesto'))->orderBy('fornitore_id')->orderBy('listino_id');
            }])->find($idFiliale)->products;
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->whereHas('listino', function($z) use($ricerca){
                    $z->where('nome', 'like', '%'.$ricerca.'%');
                })->where('stato', config('enum.statoAPA.richiesto'));
            }])->find($idFiliale)->products;
        }
    }

    public function prodottiRichiestiTutteFiliali($ricerca='')
    {
        /*dd(Filiale::with(['products' => function ($q){
            $q->with(['filiale', 'fornitore', 'listino'])->where('stato', 'RICHIESTO')->orderBy('fornitore_id')->orderBy('listino_id');
        }])->whereHas('products', function($z){
            $z->where('stato', 'RICHIESTO');
        })->get());*/

        if($ricerca == ''){
            return Filiale::with(['products' => function ($q){
                $q->with(['filiale', 'fornitore', 'listino'])->where('stato', config('enum.statoAPA.richiesto'))->orderBy('fornitore_id')->orderBy('listino_id');
            }])->whereHas('products', function($z){
                $z->where('stato', config('enum.statoAPA.richiesto'));
            })->get();
        } else {
            return Filiale::with(['products' => function ($q) use($ricerca){
                $q->with(['filiale', 'fornitore', 'listino'])->whereHas('listino', function($z) use($ricerca){
                    $z->where('nome', 'like', '%'.$ricerca.'%');
                })->where('stato', config('enum.statoAPA.richiesto'));
            }])->get()->products;
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

    public function arrivato($id)
    {
        $product = Product::find($id);
        $product->stato = config('enum.statoAPA.filiale');
        $res = $product->save();
        return $res;
    }

    public function richiedi($request)
    {
        for ($i = 1; $i <= $request['quantita']; $i++){
            Product::insert([
                'stato' => trim(Str::upper($request['stato'])),
                'fornitore_id' => $request['fornitore_id'],
                'filiale_id' => $request['filiale_id'],
                'listino_id' => $request['listino_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return 1;
    }

}

<?php


namespace App\Services;


use App\Models\Marketing;
use App\Models\User;
use Illuminate\Support\Str;
use function trim;

class MarketingService
{
    public function canali()
    {
        return Marketing::orderBy('name')->get();
    }

    public function addCanale($request)
    {
        return Marketing::create([
            'name' => trim(Str::upper($request->nome)),
            'cod' => trim(Str::upper($request->cod)),
        ]);
    }

    public function eliminaCanale($id)
    {
        return Marketing::find($id)->delete();
    }

    public function fatturatoCanali($request)
    {
        return Marketing::
            withSum(['provaFattura' => function($p) use($request){
                $p->where('anno_fine', $request->anno);
        }], 'tot')
            ->withCount(['clients' => function($c) use($request){
                $c->where('anno', $request->anno);
            }])
            ->get();
    }

    public function userFatturatoCanali($request)
    {
        $audios = User::audio()->get();
        foreach ($audios as $audio){
            $market = Marketing::
            whereHas('clients', function ($q) use($audio){
                $q->where('user_id', $audio->id);
            })
                ->withSum(
                    ['provaFattura' => function($query) use($audio, $request) {
                        $query->where([['user_id', $audio->id], ['anno_fine', $request->anno]]);
                    }],
                    'tot'
                )
                ->withCount(['clients' => function($q) use($audio, $request){
                    $q->where([['user_id', $audio->id], ['anno', $request->anno]]);
                }])
                ->get();

            $audio->valori = $market;
        }
        return $audios;
    }
}

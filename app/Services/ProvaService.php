<?php


namespace App\Services;


use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function dd;
use function trim;

class ProvaService
{

    public function inserisci($request)
    {
        //dd($request);
        return Prova::insert([
            'inizio_prova' => Carbon::now(),
            'client_id' => $request['client_id'],
            'filiale_id' => $request['filiale_id'],
            'user_id' => $request['user_id'],
            'stato' => $request['stato'],
            'created_at' => Carbon::now()
        ]);
    }

    public function rimuovi($id)
    {
        return Prova::find($id)->delete();
    }
}

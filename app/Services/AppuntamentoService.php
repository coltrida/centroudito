<?php


namespace App\Services;


use App\Models\Appuntamento;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function dd;
use function trim;

class AppuntamentoService
{
    public function appuntamenti($id)
    {
        /*dd(Client::with(['appuntamenti' => function ($q){
            $q->with(['user', 'filiale', 'recapito'])->orderBy('giorno', 'desc');
        }])->find($id)->appuntamenti);*/

        return Client::with(['appuntamenti' => function ($q){
            $q->with(['user', 'filiale', 'recapito'])->orderBy('giorno', 'asc');
        }])->find($id)->appuntamenti;
    }

    public function inserisci($request)
    {
        //dd($request);
        return Appuntamento::insert([
            'giorno' => $request['giorno'],
            'orario' => $request['ore'],
            'client_id' => $request['client_id'],
            'recapito_id' => $request['recapito_id'],
            'nota' => $request['note'],
            'user_id' => $request['user_id'],
            'filiale_id' => $request['filiale_id'],
            'created_at' => Carbon::now()
        ]);
    }

    public function rimuovi($id)
    {
        return Appuntamento::find($id)->delete();
    }
}

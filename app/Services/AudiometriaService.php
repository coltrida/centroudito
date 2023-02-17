<?php


namespace App\Services;


use App\Models\Audiometria;
use App\Models\Client;
use App\Models\Ruolo;
use App\Models\User;

class AudiometriaService
{
    public function lista($idClient)
    {
        return Client::with('audiometria')->find($idClient)->audiometria;
    }

    public function aggiungi($request)
    {
        $new = new Audiometria();
        $new->client_id = $request->client_id;
        if (isset($request->destro[1]) || isset($request->destro[2]) || isset($request->destro[3]) || isset($request->destro[4])
            || isset($request->destro[5]) || isset($request->destro[6]) || isset($request->destro[7]) || isset($request->destro[8])
            || isset($request->destro[9]))
        {
            $new->_125d = isset($request->destro[1]) ? $request->destro[1] : $request->destro[2];
            $new->_250d = isset($request->destro[2]) ? $request->destro[2] : ($request->destro[1] + $request->destro[3]) / 2;
            $new->_500d = isset($request->destro[3]) ? $request->destro[3] : ($request->destro[2] + $request->destro[4]) / 2;
            $new->_1000d = isset($request->destro[4]) ? $request->destro[4] : ($request->destro[3] + $request->destro[5]) / 2;
            $new->_1500d = isset($request->destro[5]) ? $request->destro[5] : ($request->destro[4] + $request->destro[6]) / 2;
            $new->_2000d = isset($request->destro[6]) ? $request->destro[6] : ($request->destro[5] + $request->destro[7]) / 2;
            $new->_3000d = isset($request->destro[7]) ? $request->destro[7] : ($request->destro[6] + $request->destro[8]) / 2;
            $new->_4000d = isset($request->destro[8]) ? $request->destro[8] : ($request->destro[7] + $request->destro[9]) / 2;
            $new->_6000d = isset($request->destro[9]) ? $request->destro[9] : ($request->destro[8] + $request->destro[10]) / 2;
            $new->_8000d = isset($request->destro[10]) ? $request->destro[10] : $request->destro[9];
        }

        if (isset($request->sinistro[1]) || isset($request->sinistro[2]) || isset($request->sinistro[3]) || isset($request->sinistro[4])
            || isset($request->sinistro[5]) || isset($request->sinistro[6]) || isset($request->sinistro[7]) || isset($request->sinistro[8])
            || isset($request->sinistro[9]))
        {
            $new->_125s = isset($request->sinistro[1]) ? $request->sinistro[1] : $request->sinistro[2];
            $new->_250s = isset($request->sinistro[2]) ? $request->sinistro[2] : ($request->sinistro[1] + $request->sinistro[3]) / 2;
            $new->_500s = isset($request->sinistro[3]) ? $request->sinistro[3] : ($request->sinistro[2] + $request->sinistro[4]) / 2;
            $new->_1000s = isset($request->sinistro[4]) ? $request->sinistro[4] : ($request->sinistro[3] + $request->sinistro[5]) / 2;
            $new->_1500s = isset($request->sinistro[5]) ? $request->sinistro[5] : ($request->sinistro[4] + $request->sinistro[6]) / 2;
            $new->_2000s = isset($request->sinistro[6]) ? $request->sinistro[6] : ($request->sinistro[5] + $request->sinistro[7]) / 2;
            $new->_3000s = isset($request->sinistro[7]) ? $request->sinistro[7] : ($request->sinistro[6] + $request->sinistro[8]) / 2;
            $new->_4000s = isset($request->sinistro[8]) ? $request->sinistro[8] : ($request->sinistro[7] + $request->sinistro[9]) / 2;
            $new->_6000s = isset($request->sinistro[9]) ? $request->sinistro[9] : ($request->sinistro[8] + $request->sinistro[10]) / 2;
            $new->_8000s = isset($request->sinistro[10]) ? $request->sinistro[10] : $request->sinistro[9];
        }


        $new->save();

        $utente = User::find($request->user_id);
        $propieta = 'audiometria';
        $cliente = Client::find($request->client_id);
        $testo = $utente->name.' ha salvato una audiometria per '.$cliente->cognome.' '.$cliente->nome;
        $log = new LoggingService();
        $log->scriviLog($cliente->cognome.' '.$cliente->nome, $utente, $utente->name, $propieta, $testo);

        return $new;
    }

    public function elimina($id)
    {
        return Ruolo::find($id)->delete();
    }
}

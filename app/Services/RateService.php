<?php


namespace App\Services;


use App\Models\Fattura;
use App\Models\Informazione;
use App\Models\Ratefattura;
use App\Models\Ruolo;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Support\Str;
use function trim;

class RateService
{
    public function allClientiDaSaldare()
    {
        return Fattura::with(['rate', 'prova' => function($q){
            $q->with('user');
        }])
            ->where('saldata', false)
            ->orderBy('ultima_rata')
            ->get();
    }

    public function clientiDaSaldare($idAudio)
    {
        return User::with(['clientDaSaldare' => function($q){
            $q->with('prova', 'rate')->orderBy('ultima_rata');
        }])
            ->find($idAudio)->clientDaSaldare;
    }

    public function clientiSaldati($request)
    {
        $idAudio = $request->idAudio;
        $anno = $request->anno;
        $mese = $request->mese;
        $user = User::with(['clientSaldati' => function($q) use($anno, $mese){
            $q->with(['prova' => function($p){
                $p->with(['product' => function($q){
                    $q->with('listino');
                }]);
            }, 'rate'])
                ->whereHas('prova', function($p) use($anno, $mese){
                    $p->where([['anno_fine', $anno], ['mese_fine', $mese]]);
                })->orderBy('data_saldo');
        }])
            ->find($idAudio);

        foreach ($user->clientSaldati as $cliente){
            $totSenzaIva = 0;
            foreach($cliente->prova->product as $prodotto) {
                if ($prodotto->pivot->prezzo !== 0) {
                    $importoSenzaIva = $prodotto->listino->iva == 4 ? ($prodotto->pivot->prezzo / 1.04) : ($prodotto->pivot->prezzo / 1.22);
                    $totSenzaIva += $importoSenzaIva;
                    $prodotto->senzaIva = $importoSenzaIva;
                }
            }
            $cliente->totale_senza_iva =  $totSenzaIva;
        }
//dd($user->clientSaldati);
        return $user->clientSaldati;
    }

    public function addRata($request)
    {
        Ratefattura::create([
            'importo' => $request->importo,
            'fattura_id' => $request->fatturaId,
            'note' => $request->note,
        ]);

        /*$new = new Ratefattura();
        $new->importo = $request->importo;
        $new->fattura_id = $request->fatturaId;
        $new->note = $request->note;
        $new->save();*/

        $fattura = Fattura::find($request->fatturaId);
        if ($fattura->al_saldo == $fattura->tot_fattura){
            $tipoNota = 'Acconto per un importo di € '.number_format( (float) $request->importo, '0', ',', '.');
        }else{
            $tipoNota = 'Rata per un importo di € '.number_format( (float) $request->importo, '0', ',', '.');
        }
        $fattura->al_saldo -= $request->importo;
        if ($fattura->al_saldo === 0){
            $fattura->saldata = true;
            $tipoNota = 'Saldo per un importo di € '.number_format( (float) $request->importo, '0', ',', '.');
            $fattura->data_saldo = Carbon::now();
        }
        $fattura->ultima_rata = Carbon::now();
        $fattura->save();

        $client = Client::find($fattura->prova->client_id);
        $utente = User::find($request->user_id);

        Informazione::create([
            'client_id' => $client->id,
            'giorno' => Carbon::now()->format('Y-m-d'),
            'tipo' => 'PAGAMENTI',
            'note' => $tipoNota
        ]);

        $propieta = 'rata';
        $testo = $utente->name.' ha incassato una rata di euro '.$request->importo.' per una fattura di '.$fattura->tot_fattura.' del cliente '.$client->cognome.' '.$client->nome;

        $log = new LoggingService();
        $log->scriviLog($client->cognome.' '.$client->nome, $utente, $utente->name, $propieta, $testo);
    }

    public function caricaFattura($idFattura)
    {
        return Fattura::with('prova', 'rate')
            ->find($idFattura);
    }
}

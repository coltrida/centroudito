<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Informazione;
use App\Models\Risultatitel;
use App\Models\Telefonata;
use App\Models\Tipologia;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
use function trim;

class TelefonateService
{

    public function recallOggi($idUser)
    {
       // dd($idUser);
        $oggi = Carbon::now()->format('Y-m-d');
        $user = User::with('ruolo')->find($idUser);

        if ($user->ruolo->nome === 'admin'){
            return Client::with(['tipologia:id,nome', 'recalls' => function($a){
                $a->with('user');
            },
                'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                    $q->with('copiaComm')->first();
                }])
                ->whereHas('recalls', function ($q) use($oggi){
                    $q->where([['datarecall', $oggi], ['effettuata', 0]]);
                })->orderBy('user_id')->get();
        }

        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->whereHas('recalls', function ($q) use($oggi, $idUser){
                $q->where([['datarecall', $oggi], ['effettuata', 0], ['eseguita_id', $idUser]]);
        })->orderBy('user_id')->get();
    }

    public function recallDomani($idUser)
    {
        if(Carbon::now()->dayOfWeek != 6){
            $domani = Carbon::now()->addDay()->format('Y-m-d');
        } else {
            $domani = Carbon::now()->addDays(2)->format('Y-m-d');
        }
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->whereHas('recalls', function ($q) use($domani, $idUser){
                $q->where([['datarecall', $domani], ['effettuata', 0], ['eseguita_id', $idUser]]);
            })->orderBy('user_id')->get();
    }

    public function telefonateFatteOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'recalls' => function($a){
                $a->with('user');
            }, 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->whereHas('recalls', function ($q) use($oggi){
                $q->where([['created_at', $oggi], ['effettuata', 1]])->orWhere([['updated_at', $oggi], ['effettuata', 1]]);
            })->orderBy('user_id')->get();
    }

    public function numeroTelefonateFatteOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::
            whereHas('recalls', function ($q) use($oggi){
                $q->where([['created_at', $oggi], ['effettuata', 1]])->orWhere([['updated_at', $oggi], ['effettuata', 1]]);
            })->count();
    }

    public function numeroAppuntamentiPresiOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::
        whereHas('recalls', function ($q) use($oggi){
            $q->where([['created_at', $oggi], ['effettuata', 1], ['esito', 'Preso Appuntamento']])
                ->orWhere([['updated_at', $oggi], ['effettuata', 1], ['esito', 'Preso Appuntamento']]);
        })->count();
    }

    public function recallsByIdClient($idClient)
    {
        return Client::with(['recalls' => function($q){
            $q->with('user')->orderBy('datarecall');
        }])->find($idClient)->recalls;
    }

    public function clientiMaiRichiamati()
    {
        return Client::clienti()
            ->with(['tipologia:id,nome',
                'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                    $q->with('copiaComm')->first();
                }])
            ->whereDoesntHave('recalls', function ($q){
                $q->where('effettuata', 1);
            })
            ->orderBy('user_id')
            ->get();
    }

    public function clientiNonHannoMaiPresoAppuntamenti()
    {
        return Client::clienti()
            ->with(['tipologia:id,nome',
                'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                    $q->with('copiaComm')->first();
                }])
            ->doesntHave('appuntamenti')
            ->orderBy('user_id')
            ->get();
    }

    public function clientiUnAnnoUltimoAppuntamento()
    {
        $oggi = Carbon::now();
        return Client::clienti()
            ->with(['tipologia:id,nome',
                'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                    $q->with('copiaComm')->first();
                }])
            ->has('appuntamenti')
            ->whereDoesntHave('appuntamenti', function ($q) use($oggi){
                $q->whereDate('giorno', '>', $oggi->subMonths(12));
            })
            ->orderBy('user_id')
            ->get();
    }

    public function addTelefonata($request)
    {
        $client = Client::with('user')->find($request->clientId);

        $prossimaTelefonata = Telefonata::create([
            'user_id' => $request->userId,
            'eseguita_id' => $request->eseguitaId,
            'client_id' => $request->clientId,
            'datarecall' => $request->giorno,
            'mese' => $request->esito ? Carbon::now()->month : null,
            'anno' => $request->esito ? Carbon::now()->year : null,
            'esito' => $request->esito,
            'note' => $request->note,
            'effettuata' => $request->esito ? 1 : 0,
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $utente = User::find($request->eseguitaId);
        $log = new LoggingService();
        $propieta = 'recall';
        if($request->esito){
            $testo = $utente->name.' ha telefonato a '.$client->cognome.' '.$client->nome.' ( '.$client->user->name.' ) con esito: '.$request->esito;
            Informazione::create([
                'client_id' => $client->id,
                'giorno' => Carbon::now()->format('Y-m-d'),
                'tipo' => 'TELEFONATA',
                'note' => $testo
            ]);
        }else{
            $testo = $utente->name.' ha inserito la telefonata da fare per '.$client->cognome.' '.$client->nome.' ( '.$client->user->name.' )';
        }
        $log->scriviLog($client->cognome.' '.$client->nome, $utente, $utente->name, $propieta, $testo);

        return $prossimaTelefonata;
    }

    public function aggiornaTelefonata($request)
    {
        $telefonata = Telefonata::with('client')->find($request->id);
        $telefonata->esito = $request->esito;
        $telefonata->note = $request->note;
        $telefonata->eseguita_id = $request->esito ? $request->userId : 0;
        $telefonata->effettuata = $request->esito ? 1 : 0;
        $telefonata->updated_at = Carbon::now()->format('Y-m-d');
        if ($request->esito) {
            $telefonata->mese = Carbon::now()->month;
            $telefonata->anno = Carbon::now()->year;
        }
        $telefonata->save();

        $utente = User::find($request->userId);
        $log = new LoggingService();
        $propieta = 'recall';
        if($request->esito){
            $testo = $utente->name.' ha telefonato (aggiornando) a '.$telefonata->client->cognome.' '.$telefonata->client->nome.' con esito: '.$request->esito;
            Informazione::create([
                'client_id' => $telefonata->client->id,
                'giorno' => Carbon::now()->format('Y-m-d'),
                'tipo' => 'TELEFONATA',
                'note' => $testo
            ]);
        }
        $log->scriviLog($telefonata->client->cognome.' '.$telefonata->client->nome, $utente, $utente->name, $propieta, $testo);

        return $telefonata;
    }

    public function statistiche($request)
    {
        return User::with(['risultatiTelefonate' => function($t) use($request){
            $t->where('anno', $request->anno)->orderBy('mesenumero');
        }])
            ->orderBy('name')->get();
    }

    public function daRichiamare($idUser)
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->whereHas('recalls', function ($q) use($oggi, $idUser){
                $q->where([['datarecall', '<', $oggi], ['effettuata', 0], ['eseguita_id', $idUser]]);
            })->orderBy('user_id')->get();
    }

    public function recallAutomatico($idUser)
    {
        $oggi = Carbon::now()->format('Y-m-d');
        $user = User::with('filiale', 'ruolo')->find($idUser);
        $filiali = $user->filiale->pluck('id');
        if ($user->ruolo->nome === 'amministrazione'){
            return Client::with(['tipologia:id,nome',
                'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                    $q->with('copiaComm')->first();
                }])
                ->whereHas('recalls', function ($q) use($oggi, $idUser){
                    $q->where([['datarecall', $oggi], ['effettuata', 0], ['eseguita_id', null]]);
                })->orderBy('user_id')->get();
        }
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->whereIn('filiale_id', $filiali)
            ->whereHas('recalls', function ($q) use($oggi, $idUser){
                $q->where([['datarecall', $oggi], ['effettuata', 0]]);
            })->orderBy('user_id')->get();
    }

    public function telefonateAnnoMese($request)
    {
        return Client::whereHas('recalls', function($t) use($request){
            $t->where([
                ['anno', $request->anno],
                ['mese', $request->mesenumero],
                ['eseguita_id', $request->idTelefonante],
            ]);
        })->with('recalls')->get();
    }

}

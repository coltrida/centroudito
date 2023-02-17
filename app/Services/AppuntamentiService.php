<?php


namespace App\Services;


use App\Events\CallcenterEvent;
use App\Models\Agenda;
use App\Models\Appuntamento;
use App\Models\Client;
use App\Models\Filiale;
use App\Models\Informazione;
use App\Models\Recapito;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use DB;

class AppuntamentiService
{
    public function index($idClient)
    {
        return Client::with(['appuntamenti' => function($q){
            $q->with('filiale', 'recapito', 'client')->orderBy('giorno', 'DESC');
        }])->find($idClient)->appuntamenti;
    }

    public function oggi($idAudio)
    {
        return User::with(['appuntamentiOggi' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiOggi;
    }

    public function domani($idAudio)
    {
        return User::with(['appuntamentiDomani' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiDomani;
    }

    public function lunedi($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiLunedi' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiLunedi;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays($direzione*7);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function martedi($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiMartedi' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiMartedi;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays(($direzione*7)+1);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function mercoledi($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiMercoledi' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiMercoledi;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays(($direzione*7)+2);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function giovedi($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiGiovedi' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiGiovedi;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays(($direzione*7)+3);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function venerdi($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiVenerdi' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiVenerdi;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays(($direzione*7)+4);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function sabato($idAudio, $direzione)
    {
        if ($direzione === null || $direzione == 'null'){
            return User::with(['appuntamentiSabato' => function($q){
                $q->with('client')->orderBy('orario');
            }])->find($idAudio)->appuntamentiSabato;
        }
        $giornoCalcolato = Carbon::now()->startOfWeek()->addDays(($direzione*7)+5);

        return User::with(['appuntamenti' => function($a) use($giornoCalcolato){
            $a->with('client')->where('giorno', $giornoCalcolato);
        }])->find($idAudio)->appuntamenti;
    }

    public function lunediProssimo($idAudio)
    {
        return User::with(['appuntamentiLunediProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiLunediProssimo;
    }

    public function martediProssimo($idAudio)
    {
        return User::with(['appuntamentiMartediProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiMartediProssimo;
    }

    public function mercolediProssimo($idAudio)
    {
        return User::with(['appuntamentiMercolediProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiMercolediProssimo;
    }

    public function giovediProssimo($idAudio)
    {
        return User::with(['appuntamentiGiovediProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiGiovediProssimo;
    }

    public function venerdiProssimo($idAudio)
    {
        return User::with(['appuntamentiVenerdiProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiVenerdiProssimo;
    }

    public function sabatoProssimo($idAudio)
    {
        return User::with(['appuntamentiSabatoProssimo' => function($q){
            $q->with('client')->orderBy('orario');
        }])->find($idAudio)->appuntamentiSabatoProssimo;
    }

    public function addAppuntamento($request)
    {
        $giornoDiOggi = Carbon::now();
        $dataApppuntamentoFormattata = Carbon::make($request->giorno)->format('d-m-Y');

        $newAppuntamento = new Appuntamento();
        $newAppuntamento->giorno = $request->giorno;
        $newAppuntamento->orario = $request->orario;
        $newAppuntamento->nota = $request->nota;
        $newAppuntamento->tipo = $request->tipo;
        $newAppuntamento->client_id = $request->client_id;
        $newAppuntamento->user_id = $request->user_id;
        $newAppuntamento->preso_id = $request->telefonista_id;
        $newAppuntamento->filiale_id = $request->filiale_id;
        $newAppuntamento->recapito_id = $request->recapito_id;
        $newAppuntamento->mese = $giornoDiOggi->month;
        $newAppuntamento->anno = $giornoDiOggi->year;
        $newAppuntamento->save();

        $dove = $request->filiale_id ? 'Filiale di '.Filiale::find($request->filiale_id)->nome : 'Recapito '.Recapito::find($request->recapito_id)->nome;
        $utente = User::find($request->telefonista_id);
        $cliente = Client::find($request->client_id);
        $propieta = 'appuntamento';
        $testo = $utente->name.' ha fissato un appuntamento per '.$cliente->cognome.' '.$cliente->nome.' per il giorno '.$dataApppuntamentoFormattata.' alle ore '.$request->orario.' presso '.$dove;

        Informazione::create([
            'client_id' => $request->client_id,
            'giorno' => $giornoDiOggi->format('Y-m-d'),
            'tipo' => 'APPUNTAMENTO',
            'note' => $testo
        ]);

        $log = new LoggingService();
        $log->scriviLog($cliente->cognome.' '.$cliente->nome, $utente, $utente->name, $propieta, $testo);

        if ($cliente->mail){
            Mail::to($cliente->mail)->send(new \App\Mail\Appuntamento($cliente, $newAppuntamento));
        }

        $appuntamento = Appuntamento::with('filiale', 'recapito', 'client')->find($newAppuntamento->id);

        broadcast(new CallcenterEvent($appuntamento))->toOthers();

        return $appuntamento;
    }

    public function modificaAppuntamento($request)
    {
        $dataApppuntamentoFormattata = Carbon::make($request->giorno)->format('d-m-Y');
        $appuntamento = Appuntamento::find($request->id);
        $informazione = Informazione::where([
            ['client_id', $request->client_id],
            ['tipo', 'APPUNTAMENTO'],
            ['giorno', $appuntamento->created_at->format('Y-m-d')]
        ])->first();

        $utente = User::find($request->telefonista_id);
        $cliente = Client::find($request->client_id);
        $dove = $request->filiale_id ? 'Filiale di '.Filiale::find($request->filiale_id)->nome : 'Recapito '.Recapito::find($request->recapito_id)->nome;
        $testo = $utente->name." ha modificato l'appuntamento per ".$cliente->cognome.' '.$cliente->nome.' per il giorno '.$dataApppuntamentoFormattata.' alle ore '.$request->orario.' presso '.$dove;
        $informazione->note = $testo;
        $informazione->save();

        $appuntamento->giorno = $request->giorno;
        $appuntamento->orario = $request->orario;
        $appuntamento->nota = $request->nota;
        $appuntamento->tipo = $request->tipo;
        $appuntamento->client_id = $request->client_id;
        $appuntamento->user_id = $request->user_id;
        $appuntamento->filiale_id = $request->filiale_id;
        $appuntamento->recapito_id = $request->recapito_id;
        $appuntamento->save();

        $dove = $request->filiale_id ? 'Filiale di '.Filiale::find($request->filiale_id)->nome : 'Recapito '.Recapito::find($request->recapito_id)->nome;
        $utente = User::find($request->user_id);
        $cliente = Client::find($request->client_id);
        $propieta = 'appuntamento';

        $log = new LoggingService();
        $log->scriviLog($cliente->cognome.' '.$cliente->nome, $utente, $utente->name, $propieta, $testo);

        if ($cliente->mail){
            Mail::to($cliente->mail)->send(new \App\Mail\Appuntamento($cliente, $appuntamento));
        }

        return Appuntamento::with('filiale', 'recapito', 'client')->find($appuntamento->id);
    }

    public function eliminaAppuntamento($id, $idUser)
    {
        $utente = User::find($idUser);
        $appuntamento = Appuntamento::with('client')->find($id);
        $propieta = 'appuntamento';
        $testo = $utente->name.' ha eliminato un appuntamento con id = '.$id.' per il giorno '.$appuntamento->giorno.' delle ore '.$appuntamento->orario;

        Informazione::create([
            'client_id' => $appuntamento->client->id,
            'giorno' => Carbon::now()->format('Y-m-d'),
            'tipo' => 'APPUNTAMENTO',
            'note' => $testo
        ]);

        $log = new LoggingService();
        $log->scriviLog($appuntamento->client->cognome.''.$appuntamento->client->nome, $utente, $utente->name, $propieta, $testo);

        return $appuntamento->delete();
    }

    public function dateSettimana($direzione)
    {
        $giorni = [];
        $direzioneCalcolato = $direzione === null ? 0 : (int)$direzione;

        $giorni[0] = Carbon::now()->startOfWeek()->addDays($direzioneCalcolato*7)->format('d-m-Y');
        $giorni[1] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+1)->format('d-m-Y');
        $giorni[2] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+2)->format('d-m-Y');
        $giorni[3] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+3)->format('d-m-Y');
        $giorni[4] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+4)->format('d-m-Y');
        $giorni[10] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+5)->format('d-m-Y');

        $giorni[5] = Carbon::now()->startOfWeek()->addDays($direzioneCalcolato*7)->format('Y-m-d');
        $giorni[6] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+1)->format('Y-m-d');
        $giorni[7] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+2)->format('Y-m-d');
        $giorni[8] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+3)->format('Y-m-d');
        $giorni[9] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+4)->format('Y-m-d');
        $giorni[11] = Carbon::now()->startOfWeek()->addDays(($direzioneCalcolato*7)+5)->format('Y-m-d');

        $giorni[12] = Carbon::now()->addDays($direzioneCalcolato*7)->weekOfMonth;
        //dd($giorni[12]);
        return $giorni;
    }

    public function dateSettimanaProssima()
    {
        $giorni = [];
        $giorni[0] = Carbon::now()->startOfWeek()->addDays(7)->format('d-m-Y');
        $giorni[1] = Carbon::now()->startOfWeek()->addDays(8)->format('d-m-Y');
        $giorni[2] = Carbon::now()->startOfWeek()->addDays(9)->format('d-m-Y');
        $giorni[3] = Carbon::now()->startOfWeek()->addDays(10)->format('d-m-Y');
        $giorni[4] = Carbon::now()->startOfWeek()->addDays(11)->format('d-m-Y');
        $giorni[10] = Carbon::now()->startOfWeek()->addDays(12)->format('d-m-Y');
        return $giorni;
    }

    public function appuntamentiAnnoMese($request)
    {
        return Client::whereHas('appuntamenti', function($t) use($request){
            $t->where([
                ['anno', $request->anno],
                ['mese', $request->mesenumero],
                ['preso_id', $request->idTelefonante],
            ]);
        })->with('appuntamenti')->get();
    }

    public function intervenutiAnnoMese($request)
    {
        return Client::whereHas('appuntamenti', function($t) use($request){
            $t->where([
                ['anno', $request->anno],
                ['mese', $request->mesenumero],
                ['preso_id', $request->idTelefonante],
                ['intervenuto', true]
            ]);
        })->with('appuntamenti')->get();
    }

    public function inSospeso($idAudio)
    {
        $oggi = Carbon::now()->subDay();
        return User::with(['appuntamenti' => function($q) use($oggi){
            $q->with('client')->where([
                ['giorno', '<', $oggi],
                ['intervenuto', null]
            ])->orderBy('giorno');
        }])->find($idAudio)->appuntamenti;
    }

    public function appuntamentoSaltato($request)
    {
        $appuntamento = Appuntamento::with('client')->find($request->idAppuntamento);
        $appuntamento->update(['intervenuto' => false]);
        $utente = User::find($request->user_id);
        $propieta = 'appuntamento';
        $testo = $utente->name.' ha selezionato NON INTERVENUTO per '.$appuntamento->client->cognome.' '.$appuntamento->client->nome." per l'appuntamento del ".$appuntamento->giorno;

        $log = new LoggingService();
        $log->scriviLog($appuntamento->client->cognome.''.$appuntamento->client->nome, $utente, $utente->name, $propieta, $testo);

    }

    public function appuntamentoIntervenuto($request)
    {
        $appuntamento = Appuntamento::with('client')->find($request->idAppuntamento);
        $appuntamento->update(['intervenuto' => true]);
        $utente = User::find($request->user_id);
        $propieta = 'appuntamento';
        $testo = $utente->name.' ha selezionato INTERVENUTO per '.$appuntamento->client->cognome.' '.$appuntamento->client->nome." per l'appuntamento del ".$appuntamento->giorno;

        $log = new LoggingService();
        $log->scriviLog($appuntamento->client->cognome.' '.$appuntamento->client->nome, $utente, $utente->name, $propieta, $testo);

    }

    public function appuntamentogiornoora($request)
    {
        return Appuntamento::with('client')
            ->where([
                ['giorno', $request->giorno],
                ['orario', $request->orario],
                ['user_id', $request->user_id],
            ])
            ->first();
    }

    public function dataDiOggi()
    {
        return Carbon::now()->format('d-m-Y');
    }

    public function settimanaDelMese($idAudio, $direzione)
    {
        $doveSono = [];
        $direzioneCalcolato = $direzione === null ? 0 : (int)$direzione;
        $settimanaDelMese = Carbon::now()->addDays($direzioneCalcolato*7)->weekOfMonth;

        $doveSono[0] = Agenda::where([['user_id', $idAudio], ['settimana', $settimanaDelMese], ['nome', 'mattina']])->first();
        $doveSono[1] = Agenda::where([['user_id', $idAudio], ['settimana', $settimanaDelMese], ['nome', 'pomeriggio']])->first();

        return $doveSono;
    }

    public function appuntamentiDiTuttiAudio()
    {
        $ieri = Carbon::now()->subDay();

        return User::audio()
            ->with(['appuntamentiOggi' => function($a){
                $a->with('client');
            }])
            ->withCount(['appuntamenti as sospesi' => function($q) use($ieri){
                $q->where([
                    ['giorno', '<', $ieri],
                    ['intervenuto', null]
                ]);
            }])
            ->get();
    }

    public function statistiche($request)
    {
        return User::audio()
            ->with(['Assistenza' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['Consegna' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['ControlloProva' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['EsameAudio' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['FineProva' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['Informazioni' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['PrimaVisita' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->with(['Pulizia' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ])->orderBy('giorno', 'DESC');
            }])
            ->withCount(['appuntamenti as Totale' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ]);
            }])
            ->orderBy('name')->get();
    }

    public function statisticheMesi($request)
    {
        return User::audio()
            ->withCount(['appuntamenti as gennaio' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 1]
                ]);
            }])
            ->withCount(['appuntamenti as febbraio' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 2]
                ]);
            }])
            ->withCount(['appuntamenti as marzo' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 3]
                ]);
            }])
            ->withCount(['appuntamenti as aprile' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 4]
                ]);
            }])
            ->withCount(['appuntamenti as maggio' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 5]
                ]);
            }])
            ->withCount(['appuntamenti as giugno' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 6]
                ]);
            }])
            ->withCount(['appuntamenti as luglio' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 7]
                ]);
            }])
            ->withCount(['appuntamenti as agosto' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 8]
                ]);
            }])
            ->withCount(['appuntamenti as settembre' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 9]
                ]);
            }])
            ->withCount(['appuntamenti as ottobre' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 10]
                ]);
            }])
            ->withCount(['appuntamenti as novembre' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 11]
                ]);
            }])
            ->withCount(['appuntamenti as dicembre' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 12]
                ]);
            }])
            ->withCount(['appuntamenti as totale' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                ]);
            }])
            ->orderBy('name')->get();
    }
}

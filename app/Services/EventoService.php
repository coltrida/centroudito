<?php


namespace App\Services;


use App\Models\Eventigiorno;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EventoService
{
    public function aggiungi($request)
    {
        $idUser = $request->user_id;
        $giorno = $request->giorno;
        $cosa = Str::upper($request->cosa);
        $struttura = Str::upper($request->evento);
        $quando = $request->quando;

        if ($idUser != 0){
            return $this->inserisciEventoSingolo($idUser, $giorno, $cosa, $struttura, $quando);
        } else {
            $audio = User::audio()->get();
            $res = [];
            foreach ($audio as $item) {
                array_push($res, $this->inserisciEventoSingolo($item->id, $giorno, $cosa, $struttura, $quando));
            }
            return in_array(0, $res) ? 0 : 1;
        }
    }

    public function eventoGiorno($request)
    {
        $eventi = [];
        $eventi[0] = Eventigiorno::where([
            ['giorno', $request->giorno],
            ['user_id', $request->user_id],
            ['quando', 'mattina'],
        ])->first();

        $eventi[1] = Eventigiorno::where([
            ['giorno', $request->giorno],
            ['user_id', $request->user_id],
            ['quando', 'pomeriggio'],
        ])->first();

        return $eventi;
    }

    public function settimana($idAudio, $direzione)
    {

        $eventi = [];
        if ($direzione === null || $direzione == 'null'){
            $direzione = 0;
        }

        $lunedi =    Carbon::now()->startOfWeek()->addDays($direzione*7);
        $martedi =   Carbon::now()->startOfWeek()->addDays(($direzione*7)+1);
        $mercoledi = Carbon::now()->startOfWeek()->addDays(($direzione*7)+2);
        $giovedi =   Carbon::now()->startOfWeek()->addDays(($direzione*7)+3);
        $venerdi =   Carbon::now()->startOfWeek()->addDays(($direzione*7)+4);
        $sabato =    Carbon::now()->startOfWeek()->addDays(($direzione*7)+5);

        $eventi[0][0] = Eventigiorno::where([
            ['giorno', $lunedi],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[0][1] = Eventigiorno::where([
            ['giorno', $lunedi],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        $eventi[1][0] = Eventigiorno::where([
            ['giorno', $martedi],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[1][1] = Eventigiorno::where([
            ['giorno', $martedi],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        $eventi[2][0] = Eventigiorno::where([
            ['giorno', $mercoledi],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[2][1] = Eventigiorno::where([
            ['giorno', $mercoledi],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        $eventi[3][0] = Eventigiorno::where([
            ['giorno', $giovedi],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[3][1] = Eventigiorno::where([
            ['giorno', $giovedi],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        $eventi[4][0] = Eventigiorno::where([
            ['giorno', $venerdi],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[4][1] = Eventigiorno::where([
            ['giorno', $venerdi],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        $eventi[5][0] = Eventigiorno::where([
            ['giorno', $sabato],
            ['user_id', $idAudio],
            ['quando', 'mattina'],
        ])->first();

        $eventi[5][1] = Eventigiorno::where([
            ['giorno', $sabato],
            ['user_id', $idAudio],
            ['quando', 'pomeriggio'],
        ])->first();

        return $eventi;
    }

    public function elimina($request)
    {
        if ($request[0]){
            Eventigiorno::find($request[0]['id'])->delete();
        }
        if ($request[1]){
            Eventigiorno::find($request[1]['id'])->delete();
        }

    }

    private function controllaSeEventoGiaPresente($idUser, $giorno, $quando)
    {
        return Eventigiorno::where([
                ['user_id', $idUser],
                ['quando', $quando],
                ['giorno', $giorno],
            ])->count() > 0;
    }

    private function creaEvento($idUser, $cosa, $giorno, $struttura, $quando)
    {
        return Eventigiorno::create([
            'user_id' => $idUser,
            'quando' => $quando,
            'cosa' => $cosa,
            'giorno' => $giorno,
            'evento' => $struttura
        ]);
    }

    private function inserisciEventoSingolo($idUser, $giorno, $cosa, $struttura, $quando)
    {
        if ($quando === 'giorno'){
            if ($this->controllaSeEventoGiaPresente($idUser, $giorno, 'mattina')){
                return 0;
            }

            if ($this->controllaSeEventoGiaPresente($idUser, $giorno, 'pomeriggio')){
                return 0;
            }

            $evento = $this->creaEvento($idUser, $cosa, $giorno, $struttura, 'mattina');
            $evento = $this->creaEvento($idUser, $cosa, $giorno, $struttura, 'pomeriggio');

        } else {
            if ($this->controllaSeEventoGiaPresente($idUser, $giorno, $quando)){
                return 0;
            }
            $evento = $this->creaEvento($idUser, $cosa, $giorno, $struttura, $quando);
        }

        $utente = User::find($idUser);
        $propieta = 'evento';
        $testo = $utente->name.' ha inserito un evento di '.$cosa.' per il giorno '.$giorno;

        $log = new LoggingService();
        $log->scriviLog(Str::upper($evento->cosa), $utente, $utente->name, $propieta, $testo);
        return 1;
    }
}

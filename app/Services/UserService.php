<?php


namespace App\Services;

use App\Models\Agenda;
use App\Models\Budget;
use App\Models\User;
use App\Models\Ventaglio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function setlocale;
use function trim;
use const LC_TIME;

class UserService
{
    public function audio()
    {
        return User::audio()->orderBy('name')->get();
    }

    public function userAgenda()
    {
        return User::
            whereHas('ruolo', function ($r){
                $r->where('nome', '<>', 'admin');
            })->with(['agenda' => function($q){
                $q->orderBy('settimana')->orderBy('nome');
            }])->orderBy('name')
            ->get();
    }

    public function specificoUserAgenda($id)
    {
        return User::with(['agenda' => function($q){
            $q->orderBy('settimana')->orderBy('nome');
        }])->find($id)->agenda;
    }

    public function addUserAgenda($request)
    {
        $user_id = $request->user_id;
        $settimana = $request->settimana;
        $tempo = $request->tempo;
        $agendaEsistente = Agenda::where([
            ['user_id', $user_id],
            ['settimana', $settimana],
            ['nome', $tempo]
        ])->first();
        if ($agendaEsistente){
            if ($request->giorno == 'lun'){
                $agendaEsistente->lun = $request->testo;
            } elseif ($request->giorno == 'mar'){
                $agendaEsistente->mar = $request->testo;
            } elseif ($request->giorno == 'mer'){
                $agendaEsistente->mer = $request->testo;
            } elseif ($request->giorno == 'gio'){
                $agendaEsistente->gio = $request->testo;
            } elseif ($request->giorno == 'ven'){
                $agendaEsistente->ven = $request->testo;
            }
            $agendaEsistente->save();
            return $agendaEsistente;
        } else {
            $agenda = Agenda::create([
                'nome' => $tempo,
                'settimana' => $settimana,
                'user_id' => $user_id,
                'lun' => $request->giorno == 'lun' ? $request->testo : null,
                'mar' => $request->giorno == 'mar' ? $request->testo : null,
                'mer' => $request->giorno == 'mer' ? $request->testo : null,
                'gio' => $request->giorno == 'gio' ? $request->testo : null,
                'ven' => $request->giorno == 'ven' ? $request->testo : null,
            ]);

            /*$agenda = (new Agenda())->on($this->nomeDB);
            $agenda->nome = $tempo;
            $agenda->settimana = $settimana;
            $agenda->user_id = $user_id;
            if ($request->giorno == 'lun'){
                $agenda->lun = $request->testo;
            } elseif ($request->giorno == 'mar'){
                $agenda->mar = $request->testo;
            } elseif ($request->giorno == 'mer'){
                $agenda->mer = $request->testo;
            } elseif ($request->giorno == 'gio'){
                $agenda->gio = $request->testo;
            } elseif ($request->giorno == 'ven'){
                $agenda->ven = $request->testo;
            }
            $agenda->save();*/
        }

        return $agenda;
    }

    public function audioConBgt($request)
    {
        return User::audio()->whereHas('moltiBudget', function ($m) use($request){
            $m->where('anno', $request->anno);
        })->with(['moltiBudget' => function($b) use($request){
            $b->where('anno', $request->anno);
        }])->orderBy('name')->get();
    }

    public function audioSenzaBgt($request)
    {
        return User::audio()->whereDoesntHave('moltiBudget', function ($m) use($request){
            $m->where('anno', $request->anno);
        })->orderBy('name')->get();
    }

    public function amm()
    {
        return User::amm()->orderBy('name')->get();
    }

    public function callCenter()
    {
        return User::callcenter()->orderBy('name')->get();
    }

    public function aggiungi($request)
    {
        $user = User::create([
            'name' => trim(Str::ucfirst($request->name)),
            'email' => trim(Str::lower($request->email)),
            'cleanPassword' => '123456',
            'password' => Hash::make('123456'),
            'ruolo_id' => $request->ruolo_id,
        ]);

        return $user;

        /*$new = (new User())->on($this->nomeDB);
        $new->name = trim(Str::upper($request->name));
        $new->email = trim(Str::upper($request->email));
        $new->ruolo_id = $request->ruolo_id;
        $new->save();
        return $new;*/
    }

    public function elimina($id)
    {
        User::find($id)->delete();
    }

    public function assegnaBgt($request)
    {
        $user = User::find($request->idAudio);
        $budget = Budget::create([
            'budgetAnno' => $request->budgetAnno,
            'user_id' => $request->idAudio,
            'anno' => $request->anno,
            'nome' => 'Budget',
            'stipendio' => $request->stipendio,
            'provvigione' => $request->provvigione,
            'gennaio' => $request->mese[0],
            'febbraio' => $request->mese[1],
            'marzo' => $request->mese[2],
            'aprile' => $request->mese[3],
            'maggio' => $request->mese[4],
            'giugno' => $request->mese[5],
            'luglio' => $request->mese[6],
            'agosto' => $request->mese[7],
            'settembre' => $request->mese[8],
            'ottobre' => $request->mese[9],
            'novembre' => $request->mese[10],
            'dicembre' => $request->mese[11],
        ]);
        $user->budget_id = $budget->id;
        $user->save();
        return User::with(['moltiBudget' => function($m) use($request){
            $m->where('anno', $request->anno)->first();
        }])->find($request->idAudio);
    }

    public function modificaBgt($request)
    {
        $budget = Budget::find($request->idBudget);
        $budget->budgetAnno = $request->budgetAnno;
        $budget->stipendio = $request->stipendio;
        $budget->provvigione = $request->provvigione;
        $budget->gennaio =$request->mese[0];
        $budget->febbraio = $request->mese[1];
        $budget->marzo = $request->mese[2];
        $budget->aprile = $request->mese[3];
        $budget->maggio = $request->mese[4];
        $budget->giugno = $request->mese[5];
        $budget->luglio = $request->mese[6];
        $budget->agosto = $request->mese[7];
        $budget->settembre = $request->mese[8];
        $budget->ottobre = $request->mese[9];
        $budget->novembre = $request->mese[10];
        $budget->dicembre = $request->mese[11];
        $budget->save();

        return User::with(['moltiBudget' => function($m) use($request){
            $m->where('anno', $request->anno)->first();
        }])->find($request->idAudio);
    }

    public function user($id)
    {
        return User::with('ruolo', 'recapito')->find($id);
    }

    public function situazioneMese($idAudio)
    {

        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        $nomeMese = Carbon::now()->monthName;
        $mese = Carbon::now()->month;
        $anno = Carbon::now()->year;

        if($idAudio){
            $utente = User::audio(1)->with(['provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
                $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
            },'provaReso' => function($r) use($mese, $anno){
                $r->where([['mese_fine', $mese], ['anno_fine', $anno]]);
            }, "budget:id,user_id,budgetAnno,$nomeMese as target"])
                ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                    $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
                }], 'tot')
                ->withSum('provaInCorso', 'tot')
                ->withCount('provaInCorso')
                ->find($idAudio);

            $utente->budget->target = $utente->budget_id ?
                number_format( (float) $utente->budget->target, '0', ',', '.')
                : null;
            $utente->prova_finalizzata_sum_tot = $utente->prova_finalizzata_sum_tot ?
                number_format( (float) $utente->prova_finalizzata_sum_tot, '0', ',', '.')
                : null;
            $utente->prova_in_corso_sum_tot = $utente->prova_in_corso_sum_tot ?
                number_format( (float) $utente->prova_in_corso_sum_tot, '0', ',', '.')
                : null;
            return $utente;
        }

        $utenti = User::audio(1)->with(['provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
            $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
        },'provaReso' => function($r) use($mese, $anno){
            $r->where([['mese_fine', $mese], ['anno_fine', $anno]]);
        }, "budget:id,budgetAnno,$nomeMese as target"])
            ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
            }], 'tot')
            ->withSum('provaInCorso', 'tot')
            ->withCount('provaInCorso')
            ->get();

        foreach ($utenti as $utente){
            $utente->budget->target = $utente->budget_id ?
                number_format( (float) $utente->budget->target, '0', ',', '.')
                : null;
            $utente->prova_finalizzata_sum_tot = $utente->prova_finalizzata_sum_tot ?
                number_format( (float) $utente->prova_finalizzata_sum_tot, '0', ',', '.')
                : null;
            $utente->prova_in_corso_sum_tot = $utente->prova_in_corso_sum_tot ?
                number_format( (float) $utente->prova_in_corso_sum_tot, '0', ',', '.')
                : null;
        }
        return $utenti;
    }

    public function dettaglioAudio($request)
    {
        return User::
            audio(1)
            ->with(['pezzi','moltiFatturati' => function($f) use($request){
                $f->where('anno', $request->anno);
            },'moltiDelta' => function($d) use($request){
                $d->where('anno', $request->anno);
            },'provaFinalizzata' => function ($q) use($request){
                $q->where('anno_fine', $request->anno)->orderBy('mese_fine');
            }])
            ->withCount(['prova' => function($q) use($request){
                $q->where('anno_inizio', $request->anno)->whereHas('stato', function ($s){
                    $s->where('nome', 'RESO')->orWhere('nome', 'FATTURA')->orWhere('nome', 'PROVA');
                });
            }])
            ->withCount(['provaFinalizzata as nuova' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->where('tipologia', 'Nuovo');
            }])
            ->withCount(['provaFinalizzata as riacquisto' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->where('tipologia', 'Riacquisto');
            }])
            ->withCount(['provaFinalizzata as libero' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->where('mercato', 'libero');
            }])
            ->withCount(['provaFinalizzata as riconducibile' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->where('mercato', 'riconducibile');
            }])
            ->withCount(['provaFinalizzata as sociale' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->where('mercato', 'sociale');
            }])
            ->withCount(['prova as reso' => function($q) use($request){
                $q->where('anno_fine', $request->anno)->whereHas('stato', function ($s){
                    $s->where('nome', 'RESO');
                });
            }])
            ->orderBy('name')
            ->get();
    }

    public function visualizzaSituazioneAnno($request)
    {
        $audios = User::audio(1)->get();

        foreach ($audios as $audio){
            $valori = User::audio(1)->with(['moltiBudget' => function($b) use($request){
                $b->where('anno', $request->anno);
            }])->find($audio->id)->moltiBudget
                ->concat(User::audio(1)->with(['moltiFatturati'=> function($f) use($request){
                $f->where('anno', $request->anno);
            }])->find($audio->id)->moltiFatturati)
                ->concat(User::audio(1)->with(['moltiDelta'=> function($d) use($request){
                $d->where('anno', $request->anno);
            }])->find($audio->id)->moltiDelta);
       //         ->concat(User::audio(1)->with('moltiPezzi')->find($audio->id)->moltiPezzi);
            $audio->valori = $valori;
        }

        return $audios;
    }

    public function appuntamenti($idAudio)
    {
        return User::with('client')->find($idAudio)->client;
    }

    public function ventaglioAnno($request)
    {
        return Ventaglio::with('user')->where('anno', $request->anno)->get();
    }

    public function audioSeguitiDaAmministrativa($idAmministrativa)
    {
        $audio = [];
        $filiali = User::with(['filiale' => function($q){
            $q->with('audioprot');
        }])->find($idAmministrativa)->filiale;
        //dd($filiali);
        foreach ($filiali as $filiale){
            if (count($filiale->audioprot) > 0) {
                foreach ($filiale->audioprot as $user){
                    array_push($audio, $user);
                }
            }
        }
        return $audio;
    }

    public function userTranfert($id, $idTrasferimento)
    {
        $user = User::with('client', 'provaInCorso')->find($id);
        foreach ($user->client as $cliente){
            $cliente->user_id = $idTrasferimento;
        }

        if (count($user->provaInCorso) > 0){
            foreach ($user->provaInCorso as $prova){
                $prova->user_id = $idTrasferimento;
                foreach ($prova->product as $prodotto){
                    $prodotto->user_id = $idTrasferimento;
                }
            }
        }

        $user->push();
    }

}

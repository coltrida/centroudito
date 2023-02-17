<?php


namespace App\Services;


use App\Mail\AlarmDatabaseSpace;
use App\Mail\AlarmRootPrincipale;
use App\Mail\messaggioCompleanno;
use App\Mail\RememberAppuntamento;
use App\Models\Appuntamento;
use App\Models\Client;
use App\Models\Delta;
use App\Models\Fatturati;
use App\Models\Listino;
use App\Models\Product;
use App\Models\Prova;
use App\Models\Risultatitel;
use App\Models\StatoApa;
use App\Models\Telefonata;
use App\Models\User;
use App\Models\Ventaglio;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use MySQLDump;

class ElaborazioneService
{
    public function situazioneAnno()
    {
        //dd($this->controllo()['risultato']);

        if ($this->controllo()['risultato'] == false){
            \Mail::to('coltrida@gmail.com')->send(new AlarmRootPrincipale($this->controllo()));
            $fileDaEliminare = Storage::disk('inizio')->files('/');
            foreach ($fileDaEliminare as $item){
                Storage::disk('inizio')->delete($item);
            }
            $fileDaReinserire = Storage::disk('backup')->files();
            foreach ($fileDaReinserire as $item){
                Storage::disk('inizio')->copy('vuexdocker/storage/app/backup/'.$item, '/'.$item);
            }
        }

        $oggi = Carbon::now();
        $ora = $oggi->hour;
        $anno = $oggi->year;
        $mese = $oggi->month;
        $giorno = $oggi->day;
        $idStatoFattura = StatoApa::where('nome', 'FATTURA')->first()->id;

        // attività svolte a mezzanotte
        if ($ora < 11 || $ora > 14)
     //   if ($ora > 14)
        {
            $users = User::with('budget')->audio(1)->get();

            foreach ($users as $user){
                $fatturati = Fatturati::firstOrCreate(
                    ['user_id' => $user->id, 'anno' => $anno]
                );
                $delta = Delta::firstOrCreate(
                    ['user_id' => $user->id, 'anno' => $anno]
                );
             //   $fatturati = $user->fatturati_id ? $user->fatturati : new Fatturati();
             //   $delta = $user->delta_id ? $user->delta : new Delta();
                /*$pezzi = $user->pezzi_id ? $user->pezzi : new Pezzi();*/
                $totali = [];
                $totaliBgt = [];
                /*$pezziTot = [];*/

                $ventaglio = Ventaglio::firstOrCreate(
                    ['user_id' => $user->id, 'anno' => $anno]
                );

                if ($mese >= 1) {
                    $user->budget->premio = $user->budget->gennaio;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 1], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->with(['provaReso' => function($j) use($anno){
                            $j->where('anno_fine', $anno)->withCount('product');
                        }])
                        ->find($user->id);

                    $ventaglio->tot = Product::
                    whereHas('fattura', function ($f) use($anno){
                        $f->where('anno_fattura', $anno);
                    })
                        ->whereHas('listino', function ($q){
                            $q->where('categoria_id', 1);
                        })
                        ->where([
                            ['stato_id', $idStatoFattura],
                            ['user_id', $user->id]
                        ])
                        ->count();

                    $apparecchi = Listino::apparecchi()->get();

                    foreach ($apparecchi as $apparecchio){
                        $nomeApa = str_replace(' ', '', $apparecchio->nome);
                        $idListino = $apparecchio->id;
                        $calcoloProdotto = Product::
                        whereHas('fattura', function ($f) use($anno){
                            $f->where('anno_fattura', $anno);
                        })
                            ->where([
                                ['stato_id', $idStatoFattura],
                                ['listino_id', $idListino],
                                ['user_id', $user->id]
                            ])
                            ->count();
                        $ventaglio->$nomeApa = $calcoloProdotto ?
                            $calcoloProdotto : 0;
                    }

                    $ventaglio->save();

                    //    $pezzi->premio = count($valore->provaReso) > 0 ? $valore->provaReso[0]->product_count : 0;
                    //   $pezzi->gennaio = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->gennaio = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->gennaio = number_format( (float) (($fatturati->gennaio / $valore->budget->gennaio) - 1) * 100, '1').'%';
                    //   array_push($pezziTot, $pezzi->gennaio);
                    array_push($totali, $fatturati->gennaio);
                    array_push($totaliBgt, $valore->budget->gennaio);
                }

                if ($mese >= 2) {
                    $user->budget->premio += $user->budget->febbraio;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 2], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //      $pezzi->febbraio = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->febbraio = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->febbraio = number_format( (float) (($fatturati->febbraio / $valore->budget->febbraio) - 1) * 100, '1').'%';
                    //      array_push($pezziTot, $pezzi->febbraio);
                    array_push($totali, $fatturati->febbraio);
                    array_push($totaliBgt, $valore->budget->febbraio);
                }

                if ($mese >= 3) {
                    $user->budget->premio += $user->budget->marzo;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 3], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //    $pezzi->marzo = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->marzo = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->marzo = number_format( (float) (($fatturati->marzo / $valore->budget->marzo) - 1) * 100, '1').'%';
                    //    array_push($pezziTot, $pezzi->marzo);
                    array_push($totali, $fatturati->marzo);
                    array_push($totaliBgt, $valore->budget->marzo);
                }

                if ($mese >= 4) {
                    $user->budget->premio += $user->budget->aprile;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 4], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //     $pezzi->aprile = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->aprile = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->aprile = number_format( (float) (($fatturati->aprile / $valore->budget->aprile) - 1) * 100, '1').'%';
                    //     array_push($pezziTot, $pezzi->aprile);
                    array_push($totali, $fatturati->aprile);
                    array_push($totaliBgt, $valore->budget->aprile);
                }

                if ($mese >= 5) {
                    $user->budget->premio += $user->budget->maggio;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 5], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //     $pezzi->maggio = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->maggio = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->maggio = number_format( (float) (($fatturati->maggio / $valore->budget->maggio) - 1) * 100, '1').'%';
                    //     array_push($pezziTot, $pezzi->maggio);
                    array_push($totali, $fatturati->maggio);
                    array_push($totaliBgt, $valore->budget->maggio);
                }

                if ($mese >= 6) {
                    $user->budget->premio += $user->budget->giugno;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 6], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //      $pezzi->giugno = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->giugno = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->giugno = number_format( (float) (($fatturati->giugno / $valore->budget->giugno) - 1) * 100, '1').'%';
                    //     array_push($pezziTot, $pezzi->giugno);
                    array_push($totali, $fatturati->giugno);
                    array_push($totaliBgt, $valore->budget->giugno);
                }

                if ($mese >= 7) {
                    $user->budget->premio += $user->budget->luglio;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 7], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //     $pezzi->luglio = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->luglio = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->luglio = number_format( (float) (($fatturati->luglio / $valore->budget->luglio) - 1) * 100, '1').'%';
                    //     array_push($pezziTot, $pezzi->luglio);
                    array_push($totali, $fatturati->luglio);
                    array_push($totaliBgt, $valore->budget->luglio);
                }

                if ($mese >= 8) {
                    $user->budget->premio += $user->budget->agosto;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 8], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //       $pezzi->agosto = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->agosto = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->agosto = number_format( (float) (($fatturati->agosto / $valore->budget->agosto) - 1) * 100, '1').'%';
                    //        array_push($pezziTot, $pezzi->agosto);
                    array_push($totali, $fatturati->agosto);
                    array_push($totaliBgt, $valore->budget->agosto);
                }

                if ($mese >= 9) {
                    $user->budget->premio += $user->budget->settembre;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 9], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //        $pezzi->settembre = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->settembre = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->settembre = number_format( (float) (($fatturati->settembre / $valore->budget->settembre) - 1) * 100, '1').'%';
                    //        array_push($pezziTot, $pezzi->settembre);
                    array_push($totali, $fatturati->settembre);
                    array_push($totaliBgt, $valore->budget->settembre);
                }

                if ($mese >= 10) {
                    $user->budget->premio += $user->budget->ottobre;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 10], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //       $pezzi->ottobre = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->ottobre = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->ottobre = number_format( (float) (($fatturati->ottobre / $valore->budget->ottobre) - 1) * 100, '1').'%';
                    //       array_push($pezziTot, $pezzi->ottobre);
                    array_push($totali, $fatturati->ottobre);
                    array_push($totaliBgt, $valore->budget->ottobre);
                }

                if ($mese >= 11) {
                    $user->budget->premio += $user->budget->novembre;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 11], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //       $pezzi->novembre = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->novembre = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->novembre = number_format( (float) (($fatturati->novembre / $valore->budget->novembre) - 1) * 100, '1').'%';
                    //       array_push($pezziTot, $pezzi->novembre);
                    array_push($totali, $fatturati->novembre);
                    array_push($totaliBgt, $valore->budget->novembre);
                }

                if ($mese >= 12) {
                    $user->budget->premio += $user->budget->dicembre;
                    $valore = User::with('budget')->
                    withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                        $g->where([['mese_fine', 12], ['anno_fine', $anno]]);
                    }], 'tot')
                        ->with(['provaFinalizzata' => function($e){
                            $e->withCount('product');
                        }])
                        ->find($user->id);

                    //        $pezzi->dicembre = $valore->prova_finalizzata_sum_tot ? $valore->provaFinalizzata->sum('product_count') : 0;
                    $fatturati->dicembre = $valore->prova_finalizzata_sum_tot ? $valore->prova_finalizzata_sum_tot : 0;
                    $delta->dicembre = number_format( (float) (($fatturati->dicembre / $valore->budget->dicembre) - 1) * 100, '1').'%';

                    array_push($totali, $fatturati->dicembre);
                    array_push($totaliBgt, $valore->budget->dicembre);
                }

                $fatturati->user_id = $user->id;
                $delta->user_id = $user->id;

                // -------------- calcolo fatturato totale dell'anno ---------- //
                $fatturati->budgetAnno = array_sum($totali);

                // -------------- calcolo fatturato totale dell'anno / budget anno ---------- //
                $delta->budgetAnno = number_format( (float)  ((array_sum($totali) / $user->budget->premio) - 1) * 100, '1').'%';

                // -------------- conteggio numero Clienti ---------- //
                $numeroClienti = Client::clienti()->where([
                    ['user_id', $user->id]
                ])->whereHas('prova', function ($q) use($anno){
                    $q->where('anno_inizio', $anno);
                })
                    ->count();
                $delta->stipendio = $numeroClienti;

                // -------------- conteggio numero PC ---------- //
                $numeroPC = Client::possibili()->where([
                    ['user_id', $user->id]
                ])->whereHas('prova', function ($q) use($anno){
                    $q->where('anno_inizio', $anno);
                })
                    ->count();
                $delta->provvigione = $numeroPC;

                // -------------- conteggio numero clienti + numero pc ---------- //
                $tot = $numeroClienti + $numeroPC;

                $delta->premio = $tot <> 0 ? number_format( ($numeroClienti / $tot) * 100, '2') : 0;

                $fatturati->nome = 'Fatturati';

                // -------------- conteggio media vendita ---------- //
                $fatturati->provvigione = $ventaglio->tot <> 0 ?
                    $fatturati->budgetAnno / $ventaglio->tot : 0;

                $delta->nome = 'Delta';

                $fatturati->save();
                $delta->save();
                $user->fatturati_id = $fatturati->id;
                $user->delta_id = $delta->id;
                $user->push();
            }

            // -------------- conteggio giorni in prova delle prove in corso ---------- //
            $this->conteggioGiorniDiProva($oggi);

            // -------------- conteggio giorni di reso dei prodotti in magazzino o in prova e inserimento allarme ---------- //
            $this->conteggioGiorniDiResoProdottiInMagazzino($oggi);

            // -------------- statistiche telefonate ---------- //
            $this->eseguiStatisticheTelefonate($anno);

            // -------------- Backup ---------- //
            $this->eseguiBackup();

            // -------------- Eliminazione dei servizi rimasti nei prodotti senza essere in una prova ---------- //
            $this->eliminaProveSenzaProdotti();

            // -------------- Controllo e pulizia file di log ---------- //
            $this->controlloDimensioneFileLog();

            // -------------- Controllo possibili duplicati ---------- //
            $this->controlloPossibiliDuplicati();

            if ((float) $this->controlloDimensioneDataBase() > 800) {
                \Mail::to('coltrida@gmail.com')->send(new AlarmDatabaseSpace($this->controlloDimensioneDataBase()));
            }

        }
        else
            // attività svolte a mezzogiorno
        {
            $utentiAppuntamentoDomani = $this->selezionaClientiConAppuntamentiDomaniConEmail($oggi->addDay()->format('Y-m-d'));
            foreach ($utentiAppuntamentoDomani as $utente){
                \Mail::to($utente->mail)->send(new RememberAppuntamento($utente));
                $propieta = 'MAIL';
                $testo = 'Il sistema ha inviato una mail di remind appuntamento per '.$utente->fullname;
                $log = new LoggingService();
                $log->scriviLog($utente->cognome.' '.$utente->nome, $utente, $utente->name, $propieta, $testo);
            }
            $compleanni = Client::whereHas('tipologia', function ($t){
                $t->where('nome', 'CL');
            })
                ->where([
                    ['giornoNascita', $giorno],
                    ['meseNascita', $mese]
                ])->get();
            foreach ($compleanni as $compleanno){
                \Mail::to($compleanno->mail)->send(new messaggioCompleanno($compleanno));
                $propieta = 'MAIL';
                $testo = 'Il sistema ha inviato una mail di auguri compleanno per '.$compleanno->fullname;
                $log = new LoggingService();
                $log->scriviLog($compleanno->cognome.' '.$compleanno->nome, $compleanno, $compleanno->name, $propieta, $testo);
            }
        }
    }

        public function controlloPossibiliDuplicati()
    {
        $possibiliDoppioni = collect([]);
        Client::orderBy('nome')
            ->orderBy('cognome')
            ->orderBy('citta')
            ->chunk(20, function ($clients) use($possibiliDoppioni){
            for ($i=0; $i<count($clients)-1; $i++) {
                if (
                    ($clients[$i]->nome === $clients[$i+1]->nome) &&
                    ($clients[$i]->cognome === $clients[$i+1]->cognome) &&
                    ($clients[$i]->citta === $clients[$i+1]->citta) &&
                    (Str::contains($clients[$i]->indirizzo, Str::substr($clients[$i+1]->indirizzo, 0, 8)))
                ) {
                   // dd($clients[$i]);
                    $possibiliDoppioni->push($clients[$i]);
                    $possibiliDoppioni->push($clients[$i+1]);
                }
            }
        });
        foreach ($possibiliDoppioni as $key => $item){
            echo $item->nome.' '.$item->cognome.' --- '.$item->citta.'----'.$item->indirizzo."<br>";
            if ($key % 2 !== 0){
                echo "<hr>";
            }
        }
       // return $possibiliDoppioni;
    }

    private function selezionaClientiConAppuntamentiDomaniConEmail($domani)
    {
        return Client::with('appuntamenti')
            ->where([['mail', '!=', null], ['mail', '!=', '']])
            ->whereHas('appuntamenti', function ($a) use($domani){
                $a->with('filiale', 'recapito')->where('giorno', $domani);
            })
            ->get();
    }

    private function eliminaProveSenzaProdotti()
    {
        Product::where([
            ['matricola', null],
            ['stato_id', 5],
        ])->delete();
    }

    private function eseguiBackup()
    {
        $mysqlDatabaseName = env('DB_DATABASE');
        $mysqlUserName     = env('DB_USERNAME');
        $mysqlPassword     = env('DB_PASSWORD');
        $mysqlHostName     = env('DB_HOST');

        $db = new \mysqli($mysqlHostName, $mysqlUserName, $mysqlPassword, $mysqlDatabaseName);
        $dump = new MySQLDump($db);

        $dump->save('storage/export.sql');
    }

    private function eseguiStatisticheTelefonate($anno)
    {
        setlocale(LC_TIME, 'it_IT');
        $users = User::all();
        foreach ($users as $user){
            $idCall = $user->id;
            Carbon::setLocale('it');
            for ($meseRecall = 1; $meseRecall <= 12; $meseRecall++){
                $telefonateFatte = Telefonata::where([
                    ['anno', $anno],
                    ['effettuata', 1],
                    ['mese', $meseRecall],
                    ['eseguita_id', $idCall],
                ])->count();
                $appuntamenti = Telefonata::where([
                    ['anno', $anno],
                    ['effettuata', 1],
                    ['mese', $meseRecall],
                    ['eseguita_id', $idCall],
                    ['esito', 'Preso Appuntamento'],
                ])->count();
                $intervenuti = Appuntamento::where([
                    ['anno', $anno],
                    ['intervenuto', 1],
                    ['preso_id', $idCall],
                    ['mese', $meseRecall],
                ])->count();
                if ($telefonateFatte > 0){
                    Risultatitel::updateOrCreate(
                        [
                            'user_id' => $idCall,
                            'anno' => $anno,
                            'mesenumero' => $meseRecall,
                        ],
                        [
                            'mese' => Carbon::make('01-'.$meseRecall.'-'.$anno)->monthName,
                            'telefonate' => $telefonateFatte,
                            'appuntamenti' => $appuntamenti,
                            'intervenuti' => $intervenuti,
                        ]
                    );
                }
            }
        }

    }

    private function conteggioGiorniDiResoProdottiInMagazzino($oggi)
    {
        $prodotti = Product::with('listino')->whereHas('stato', function ($q){
            $q->where('nome', 'DDT')
                ->orWhere('nome', 'RESO')
                ->orWhere('nome', 'PROVA')
                ->orWhere('nome', 'FILIALE')
                ->orWhere('nome', 'IMMATRICOLATO');
        })->get();
        foreach ($prodotti as $prodotto){
            if($oggi->diffInDays($prodotto->datacarico) > (int)$prodotto->listino->giorniTempoDiReso - 10){
                $prodotto->pericoloRestituzione = true;
            };
        }
    }

    private function conteggioGiorniDiProva($oggi)
    {
        $prove = Prova::with('stato')->whereHas('stato', function ($q){
            $q->where('nome', 'PROVA');
        })->get();
        foreach ($prove as $prova){
            $prova->giorni_prova = $oggi->DiffInDays($prova->created_at);
            $prova->save();
        }
    }

    private function controlloDimensioneDataBase()
    {
        $sql2 = "SELECT
            table_schema AS 'Sql1398890_4',
            ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'size'
        FROM
            information_schema.tables
        GROUP BY
            table_schema";
        return collect(\DB::select($sql2))->sum('size');
    }

    private function controlloDimensioneFileLog()
    {
        $byte = Storage::disk('log')->size('/logs/laravel.log');
        if ($byte > 50000000){
            Storage::disk('log')->delete('/logs/laravel.log');
            Storage::disk('log')->put('/logs/laravel.log', '');
        }

    }

    public function controllo()
    {
        $tuttiFile = Storage::disk('inizio')->files('/');
        //return Storage::disk('local')->files('/backup/');
        //return ($tuttiFile);
        return
            [
                'risultato' =>
                count($tuttiFile) === 7 &&
                Storage::disk('inizio')->size($tuttiFile[0]) === 603 &&
                Storage::disk('inizio')->size($tuttiFile[1]) === 211 &&
                Storage::disk('inizio')->size($tuttiFile[2]) === 0 &&
                Storage::disk('inizio')->size($tuttiFile[3]) === 1767 &&
                Storage::disk('inizio')->size($tuttiFile[4]) === 72 &&
                Storage::disk('inizio')->size($tuttiFile[5]) === 24 &&
                Storage::disk('inizio')->size($tuttiFile[6]) === 1211,
                'sommaFile' => count($tuttiFile),
                $tuttiFile[0] => Storage::disk('inizio')->size($tuttiFile[0]),
                $tuttiFile[1] => Storage::disk('inizio')->size($tuttiFile[1]),
                $tuttiFile[2] => Storage::disk('inizio')->size($tuttiFile[2]),
                $tuttiFile[3] => Storage::disk('inizio')->size($tuttiFile[3]),
                $tuttiFile[4] => Storage::disk('inizio')->size($tuttiFile[4]),
                $tuttiFile[5] => Storage::disk('inizio')->size($tuttiFile[5]),
                $tuttiFile[6] => Storage::disk('inizio')->size($tuttiFile[6])
            ];
    }
}

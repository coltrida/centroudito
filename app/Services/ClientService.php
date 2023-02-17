<?php


namespace App\Services;


use App\Exports\ClientExport;
use App\Mail\ErroreImport;
use App\Mail\inviaMessaggio;
use App\Models\Appuntamento;
use App\Models\Audiometria;
use App\Models\Client;
use App\Models\Filiale;
use App\Models\Informazione;
use App\Models\Marketing;
use App\Models\Prova;
use App\Models\Recapito;
use App\Models\Telefonata;
use App\Models\Tipologia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Facades\Excel;
use function dd;
use function trim;

class ClientService
{
    public function lista()
    {
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
                ->orderBy('cognome')->get();
    }

    public function clienteFiliale($idFiliale)
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome',
            'recapito:id,nome', 'medico:id,nome,cognome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->withCount(['recalls' => function($r) use($oggi){
                $r->where([
                    ['created_at', $oggi],
                    ['effettuata', 1],
                ])->orWhere([
                    ['updated_at', $oggi],
                    ['effettuata', 1],
                ]);
            }])
            ->where('filiale_id', $idFiliale)
            ->whereHas('tipologia', function($q){
                $q->where('nome', '!=', 'DEC');
            })
            ->orderBy('cognome')
        //    ->get();
            ->paginate(10);
    }

    public function clientsFilialeNoPaginate($request)
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome',
            'recapito:id,nome', 'medico:id,nome,cognome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->withCount(['recalls' => function($r) use($oggi){
                $r->where([
                    ['created_at', $oggi],
                    ['effettuata', 1],
                ])->orWhere([
                    ['updated_at', $oggi],
                    ['effettuata', 1],
                ]);
            }])
            ->where('filiale_id', $request->idFiliale)
            ->whereHas('tipologia', function($q){
                $q->where('nome', '!=', 'DEC');
            })
            ->orderBy('cognome')
                ->get();
    }

    public function filtraCliente($request)
    {
        $idFiliale = $request->idFiliale;
        $testo = $request->testo;
        $oggi = Carbon::now()->format('Y-m-d');
        return Client::with(['tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome',
            'recapito:id,nome', 'medico:id,nome,cognome', 'audiometria', 'prova' => function($q){
                $q->with('copiaComm')->first();
            }])
            ->withCount(['recalls' => function($r) use($oggi){
                $r->where([
                    ['created_at', $oggi],
                    ['effettuata', 1],
                ])->orWhere([
                    ['updated_at', $oggi],
                    ['effettuata', 1],
                ]);
            }])
            ->where('filiale_id', $idFiliale)
            ->where(function($query) use($testo) {
                $query->where('nome', 'like', '%'.$testo.'%')
                        ->orWhere('cognome', 'like', '%'.$testo.'%')
                        ->orWhere('fullname', 'like', '%'.$testo.'%');
            })
            ->whereHas('tipologia', function($q){
                $q->where('nome', '!=', 'DEC');
            })
            ->orderBy('cognome')
            //    ->get();
            ->paginate(10);
    }

    public function cliente($id)
    {
        return Client::with('tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome')->find($id);
    }

    public function compleanni($idAudio)
    {
        return User::with('clientCompleanno')->find($idAudio)->clientCompleanno;
    }

    public function aggiungi($request)
    {
        $sonoInModificaUtente = isset($request->id) ? true : false;
        $client = $sonoInModificaUtente ? Client::find($request->id) : new Client();
        $this->inserisciOModificaClienteConDatiPassati($request, $client);
        if(!$sonoInModificaUtente){
            $this->inserisciMeseEdAnnoDiIngresso($client);
        }

        if($client->tipologia_id && !$sonoInModificaUtente){
            $this->inserisciRecallAutomatico($client, $client->id);
        }

        $utente = User::find($request->eseguito_id);
        $propieta = 'CLIENT';
        $testo = $sonoInModificaUtente ? $utente->name.' ha modificato il nominativo '.$client->cognome.' '.$client->nome :
            $utente->name.' ha inserito il nominativo '.$client->cognome.' '.$client->nome;

        $this->scriviSuLog($utente, $propieta, $client, $testo);
        $this->creaInformazione($client, $propieta, $testo);

        return $client;
    }

    public function elimina($request)
    {
        $client = Client::find($request->clientId);
        $client->audiometria->each->delete();
        $utente = User::find($request->userId);
        $propieta = 'CLIENT';
        $testo = $utente->name.' ha eliminato il nominativo '.$client->cognome.' '.$client->nome;

        $this->scriviSuLog($utente, $propieta, $client, $testo);
        return $client->delete();
    }

    public function ingressiRecapiti($request)
    {
        return Recapito::
            withcount(['clients' => function($c) use($request){
                $c->where('anno', $request->anno);
        }])
            ->withCount(['clients as clientsPc' => function($q) use($request){
                $q->where('anno', $request->anno)->whereHas('tipologia', function ($r){
                    $r->where('nome', 'PC');
                });
            }])
            ->withCount(['clients as clientsCl' => function($q) use($request){
                $q->where('anno', $request->anno)->whereHas('tipologia', function ($r){
                    $r->where('nome', 'CL');
                });
            }])
            ->withCount(['clients as clientsClc' => function($q) use($request){
                $q->where('anno', $request->anno)->whereHas('tipologia', function ($r){
                    $r->where('nome', 'CLC');
                });
            }])
            ->withCount(['clients as clientsNormo' => function($q) use($request){
                $q->where('anno', $request->anno)->whereHas('tipologia', function ($r){
                    $r->where('nome', 'NORMO');
                });
            }])
            ->withCount(['clients as clientsLe' => function($q) use($request){
                $q->where('anno', $request->anno)->whereHas('tipologia', function ($r){
                    $r->where('nome', 'LE');
                });
            }])
            ->orderBy('nome')
            ->get();
    }

    public function ingressiRecapitiMesi($request)
    {
        return Recapito::
            withcount(['clients' => function($q) use($request){
                $q->where('anno', $request->anno);
            }])
            ->withCount(['clients as gen' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 1],
                ]);
            }])
            ->withCount(['clients as feb' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 2],
                ]);
            }])
            ->withCount(['clients as mar' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 3],
                ]);
            }])
            ->withCount(['clients as apr' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 4],
                ]);
            }])
            ->withCount(['clients as mag' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 5],
                ]);
            }])
            ->withCount(['clients as giu' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 6],
                ]);
            }])
            ->withCount(['clients as lug' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 7],
                ]);
            }])
            ->withCount(['clients as ago' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 8],
                ]);
            }])
            ->withCount(['clients as set' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 9],
                ]);
            }])
            ->withCount(['clients as ott' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 10],
                ]);
            }])
            ->withCount(['clients as nov' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 11],
                ]);
            }])
            ->withCount(['clients as dic' => function($q) use($request){
                $q->where([
                    ['anno', $request->anno],
                    ['mese', 12],
                ]);
            }])
            ->orderBy('nome')
            ->get();
    }

    public function province()
    {
        return Client::orderBy('provincia')
            ->where([['provincia', '!=', null], ['provincia', '!=', '']])
            ->get()
            ->unique('provincia')
            ->pluck('provincia');
    }



    public function importClientsFromNoah($request)
    {
        //dd($request);
        $tot = 0;
        $idListaEsterna = Tipologia::where('nome', 'LE')->first()->id;
        $xmlDataString = file_get_contents(asset('/storage/'.$request['nomeFile']));
        $res = 0;
        $possibiliDoppioni = collect([]);
        $originaliDaInserire = collect([]);
        $listaSenzaFilialeAssegnata = collect([]);
        try {
            $xml = simplexml_load_string($xmlDataString, NULL, NULL, "http://www.himsa.com/Measurement/PatientExport.xsd");
            foreach ($xml->Patient as $ele){
                //  dd((string)$ele->Patient->Province);
                $risultatiDecriptazioneStruttura = $this->decriptazioneStruttura(trim(Str::upper($ele->Patient->Other2)));
                $idFiliale = $risultatiDecriptazioneStruttura[0];
                $idRecapito = $risultatiDecriptazioneStruttura[1];
                $risultatiDecriptazioneCodMkt = $this->decriptazioneCodiceMarketing(trim(Str::upper($ele->Patient->Other1)));
                $idCodMkt = $risultatiDecriptazioneCodMkt[0];
                $idMedico = $risultatiDecriptazioneCodMkt[1];

                if ($doppione = $this->verificaNonSiaDoppione($ele))
                {
                    $possibiliDoppioni->push($doppione);
                    $originaliDaInserire->push($this->inserisciElementoInListaOriginaliDaInserire($doppione->id, $ele, $request, $idRecapito, $idMedico, $idCodMkt, $idFiliale, $idListaEsterna));
                }
                else {
                    $idFiliale = $idFiliale ? $idFiliale : $this->getFilialeFromPlace(Str::of(Str::upper($ele->Patient->Other1))->trim(),
                        Str::of(Str::upper($ele->Patient->City))->trim());
                    if ($idFiliale){
                        $client = $this->inserimentoDatiDaFileXml($ele, $request, $idRecapito, $idMedico, $idCodMkt, $idFiliale, $idListaEsterna);

                        $idCliente = $client->id;

                        if ($client->wasRecentlyCreated){
                            $tot++;
                            if($clientInseritoDaCallCenter = $this->appuntamentoPresoRecentementeDaCallCenter($client)){
                                $this->copiaAnagrafica($clientInseritoDaCallCenter, $client);
                                $idCliente = $clientInseritoDaCallCenter->id;
                                $this->segnaAppuntamentoIntervenuto($clientInseritoDaCallCenter);
                                $client->delete();
                            }

                            Informazione::create([
                                'client_id' => $idCliente,
                                'tipo' => 'INGRESSO',
                                'note' => 'Ingresso presso.....tramite il canale mkt....',
                                'giorno' => $clientInseritoDaCallCenter ? $clientInseritoDaCallCenter->created_at->format('Y-m-d') : $client->created_at->format('Y-m-d'),
                            ]);
                            if (!$clientInseritoDaCallCenter && $client->tipologia_id != $idListaEsterna){
                                $this->inserisciRecallAutomatico($client, $idCliente);
                            } elseif ($clientInseritoDaCallCenter && $clientInseritoDaCallCenter->tipologia_id != $idListaEsterna){
                                $this->inserisciRecallAutomatico($clientInseritoDaCallCenter, $idCliente);
                            }
                        }

                        $audiometriad = null;
                        $audiometrias = null;
                        //dd($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0]);
                        if (isset($ele->Patient->Actions)){
                            if (isset($ele->Patient->Actions->Action)){
                                if (isset($ele->Patient->Actions->Action->PublicData)){
                                    if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard)){
                                        //dd((string)$ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0]->AudMeasurementConditions->StimulusSignalOutput);
                                        if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0])){
                                            if ((string)$ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0]->AudMeasurementConditions->StimulusSignalOutput == 'AirConductorLeft'){
                                                $audiometrias = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0];
                                            } elseif ((string)$ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0]->AudMeasurementConditions->StimulusSignalOutput == 'AirConductorRight'){
                                                $audiometriad = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0];
                                            }
                                        }
                                        if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[2])){
                                            $ossead = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[2];
                                        }
                                    }
                                }
                            }
                        }

                        if (isset($ele->Patient->Actions)){
                            if (isset($ele->Patient->Actions->Action)){
                                if (isset($ele->Patient->Actions->Action->PublicData)){
                                    if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard)){
                                        if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1])){
                                            if ((string)$ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1]->AudMeasurementConditions->StimulusSignalOutput == 'AirConductorLeft'){
                                                $audiometrias = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1];
                                            } elseif ((string)$ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1]->AudMeasurementConditions->StimulusSignalOutput == 'AirConductorRight'){
                                                $audiometriad = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1];
                                            }

                                            //$audiometrias = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1];
                                        }
                                        if (isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[3])){
                                            $osseas = $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[3];
                                        }
                                    }
                                }
                            }
                        }

                        /*$audiometriad = isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0]) ?
                            $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[0] : null;
                        $audiometrias = isset($ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1]) ?
                            $ele->Patient->Actions->Action->PublicData->children()->HIMSAAudiometricStandard->ToneThresholdAudiogram[1] : null;*/

                        $d125 = null;
                        $d250 = null;
                        $d500 = null;
                        $d1000 = null;
                        $d1500 = null;
                        $d2000 = null;
                        $d3000 = null;
                        $d4000 = null;
                        $d6000 = null;
                        $d8000 = null;

                        $s125 = null;
                        $s250 = null;
                        $s500 = null;
                        $s1000 = null;
                        $s1500 = null;
                        $s2000 = null;
                        $s3000 = null;
                        $s4000 = null;
                        $s6000 = null;
                        $s8000 = null;

                        $ossd125 = null;
                        $ossd250 = null;
                        $ossd500 = null;
                        $ossd1000 = null;
                        $ossd1500 = null;
                        $ossd2000 = null;
                        $ossd3000 = null;
                        $ossd4000 = null;
                        $ossd6000 = null;
                        $ossd8000 = null;

                        $osss125 = null;
                        $osss250 = null;
                        $osss500 = null;
                        $osss1000 = null;
                        $osss1500 = null;
                        $osss2000 = null;
                        $osss3000 = null;
                        $osss4000 = null;
                        $osss6000 = null;
                        $osss8000 = null;

                        if (isset($audiometriad->TonePoints)) {
                            foreach ($audiometriad->TonePoints as $tono){
                                ${'d'.(string)$tono->StimulusFrequency} = $tono->StimulusLevel;
                            }
                        }

                        if (isset($audiometrias->TonePoints)) {
                            foreach ($audiometrias->TonePoints as $tono){
                                ${'s'.(string)$tono->StimulusFrequency} = $tono->StimulusLevel;
                            }
                        }

                        if (isset($ossead->TonePoints)) {
                            foreach ($ossead->TonePoints as $tono){
                                ${'ossd'.(string)$tono->StimulusFrequency} = $tono->StimulusLevel;
                            }
                        }

                        if (isset($osseas->TonePoints)) {
                            foreach ($osseas->TonePoints as $tono){
                                ${'osss'.(string)$tono->StimulusFrequency} = $tono->StimulusLevel;
                            }
                        }


                        $audiom = Audiometria::where('client_id', $idCliente)->firstOrNew();

                        if(!isset($audiom->client_id)){
                            $audiom->client_id = $client->id;
                            $audiom->_125d = (int)$d125 ? (int)$d125 : (int)$d250;
                            $audiom->_250d = (int)$d250 ? (int)$d250 : ( (int)$d125 + (int)$d500 ) / 2;
                            $audiom->_500d = (int)$d500 ? (int)$d500 : ( (int)$d250 + (int)$d1000 ) / 2;
                            $audiom->_1000d = (int)$d1000? (int)$d1000 : ( (int)$d500 + (int)$d1500 ) / 2;
                            $audiom->_1500d = (int)$d1500? (int)$d1500 : ( (int)$d1000 + (int)$d2000 ) / 2;
                            $audiom->_2000d = (int)$d2000? (int)$d2000 : ( (int)$d1500 + (int)$d3000 ) / 2;
                            $audiom->_3000d = (int)$d3000? (int)$d3000 : ( (int)$d2000 + (int)$d4000 ) / 2;
                            $audiom->_4000d = (int)$d4000? (int)$d4000 : ( (int)$d3000 + (int)$d6000 ) / 2;
                            $audiom->_6000d = (int)$d6000? (int)$d6000 : ( (int)$d4000 + (int)$d8000 ) / 2;
                            $audiom->_8000d = (int)$d8000? (int)$d8000 :  (int)$d6000;

                            $audiom->_125s = (int)$s125 ? (int)$s125 : (int)$s250;
                            $audiom->_250s = (int)$s250 ? (int)$s250 : ( (int)$s125 + (int)$s500 ) / 2;
                            $audiom->_500s = (int)$s500 ? (int)$s500 : ( (int)$s250 + (int)$s1000 ) / 2;
                            $audiom->_1000s = (int)$s1000? (int)$s1000 : ( (int)$s500 + (int)$s1500 ) / 2;
                            $audiom->_1500s = (int)$s1500? (int)$s1500 : ( (int)$s1000 + (int)$s2000 ) / 2;
                            $audiom->_2000s = (int)$s2000? (int)$s2000 : ( (int)$s1500 + (int)$s3000 ) / 2;
                            $audiom->_3000s = (int)$s3000? (int)$s3000 : ( (int)$s2000 + (int)$s4000 ) / 2;
                            $audiom->_4000s = (int)$s4000? (int)$s4000 : ( (int)$s3000 + (int)$s6000 ) / 2;
                            $audiom->_6000s = (int)$s6000? (int)$s6000 : ( (int)$s4000 + (int)$s8000 ) / 2;
                            $audiom->_8000s = (int)$s8000? (int)$s8000 :  (int)$s6000;

                            $audiom->_125ossd = (int)$ossd125 ? (int)$ossd125 : null;
                            $audiom->_250ossd = (int)$ossd250 ? (int)$ossd250 : null;
                            $audiom->_500ossd = (int)$ossd500 ? (int)$ossd500 : null;
                            $audiom->_1000ossd = (int)$ossd1000? (int)$ossd1000 : null;
                            $audiom->_1500ossd = (int)$ossd1500? (int)$ossd1500 : null;
                            $audiom->_2000ossd = (int)$ossd2000? (int)$ossd2000 : null;
                            $audiom->_3000ossd = (int)$ossd3000? (int)$ossd3000 : null;
                            $audiom->_4000ossd = (int)$ossd4000? (int)$ossd4000 : null;
                            $audiom->_6000ossd = (int)$ossd6000? (int)$ossd6000 : null;
                            $audiom->_8000ossd = (int)$ossd8000? (int)$ossd8000 :  null;

                            $audiom->_125osss = (int)$osss125 ? (int)$osss125 : null;
                            $audiom->_250osss = (int)$osss250 ? (int)$osss250 : null;
                            $audiom->_500osss = (int)$osss500 ? (int)$osss500 : null;
                            $audiom->_1000osss = (int)$osss1000? (int)$osss1000 : null;
                            $audiom->_1500osss = (int)$osss1500? (int)$osss1500 : null;
                            $audiom->_2000osss = (int)$osss2000? (int)$osss2000 : null;
                            $audiom->_3000osss = (int)$osss3000? (int)$osss3000 : null;
                            $audiom->_4000osss = (int)$osss4000? (int)$osss4000 : null;
                            $audiom->_6000osss = (int)$osss6000? (int)$osss6000 : null;
                            $audiom->_8000osss = (int)$osss8000? (int)$osss8000 :  null;

                            $res = $audiom->save();

                        }
                    } else {
                        $listaSenzaFilialeAssegnata->push($this->inserisciElementoInListaOriginaliDaInserire(null, $ele, $request, $idRecapito, $idMedico, $idCodMkt, $idFiliale, $idListaEsterna));
                    }
                }
            }
        } catch ( \Exception $e) {
            $res = 2;
            \Mail::to('coltrida@gmail.com')->send(new ErroreImport($e->getMessage(), User::find($request['idUser'])->name));
        }

//dd($xml->Patient);


        $log = new LoggingService();
        $log->scriviLog('import from Noah', '', User::find($request['idUser'])->name, 'import from Noah', 'import from Noah. (Inseriti: '.$tot.')');

        return [$res, $tot, $possibiliDoppioni, $originaliDaInserire, $listaSenzaFilialeAssegnata];
    }

    public function ricercaNominativi($request)
    {
        $condizioni = [];
        if ($request->tipo){
            array_push($condizioni, ['tipologia_id', $request->tipo]);
        }
        if ($request->provincia){
            array_push($condizioni, ['provincia', $request->provincia]);
        }
        if ($request->citta){
            array_push($condizioni, ['citta', $request->citta]);
        }
        if ($request->filiale){
            array_push($condizioni, ['filiale_id', $request->filiale]);
        }
        if ($request->acquistatoAnniFa){
            $annoRicerca = Carbon::now()->year - $request->acquistatoAnniFa;
            return Client::whereHas('prova', function($p) use($annoRicerca){
                $p->where('anno_fine', '<=', $annoRicerca)->whereHas('stato', function($q){
                    $q->where('nome', 'FATTURA');
                }) ;
            })
                ->where($condizioni)
                ->orderBy('cognome')->get();
        }

        return Client::with('tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova')
            ->where($condizioni)
            ->orderBy('cognome')->get();
    }

    public function ricercaNominativiConMail($request)
    {
        $condizioni = [];
        if ($request->tipo){
            array_push($condizioni, ['tipologia_id', $request->tipo]);
        }
        if ($request->provincia){
            array_push($condizioni, ['provincia', $request->provincia]);
        }
        if ($request->citta){
            array_push($condizioni, ['citta', $request->citta]);
        }
        if ($request->filiale){
            array_push($condizioni, ['filiale_id', $request->filiale]);
        }
        if ($request->acquistatoAnniFa){
            $annoRicerca = Carbon::now()->year - $request->acquistatoAnniFa;
            return Client::whereHas('prova', function($p) use($annoRicerca){
                $p->where('anno_fine', '<=', $annoRicerca)->whereHas('stato', function($q){
                    $q->where('nome', 'FATTURA');
                }) ;
            })
                ->where($condizioni)
                ->orderBy('cognome')->get();
        }

        return Client::with('tipologia:id,nome',
            'marketing', 'user:id,name', 'filiale:id,nome', 'recapito:id,nome', 'audiometria', 'prova')
            ->where($condizioni)
            ->where([['mail', '!=', null], ['mail', '!=', '']])
            ->orderBy('cognome')->get();
    }

    public function situazioneAnnoClientiAudio($request)
    {
        return User::with(['prova' => function($p) use($request){
            $p->where('anno_fine', $request->anno)->whereHas('stato', function ($t){
                $t->where('nome', 'FATTURA');
            })->with('client');
        }])
            ->withCount(['prova as libero' => function ($prova) use($request){
                $prova->where([['anno_fine', $request->anno], ['mercato', 'libero']])->whereHas('stato', function ($t){
                    $t->where('nome', 'FATTURA');
                });
            }])
            ->withCount(['prova as riconducibile' => function ($prova) use($request){
                $prova->where([['anno_fine', $request->anno], ['mercato', 'riconducibile']])->whereHas('stato', function ($t){
                    $t->where('nome', 'FATTURA');
                });
            }])
            ->withCount(['prova as sociale' => function ($prova) use($request){
                $prova->where([['anno_fine', $request->anno], ['mercato', 'sociale']])->whereHas('stato', function ($t){
                    $t->where('nome', 'FATTURA');
                });
            }])
            ->find($request->userId);
    }

    public function situazioneAnnoResiAudio($request)
    {
        return Prova::
        with('client')
            ->where([
                ['user_id', $request->userId],
                ['anno_fine', $request->anno],
            ])->whereHas('stato', function ($t){
                $t->where('nome', 'RESO');
            })
            ->latest()
            ->get();
    }

    public function riepilogo()
    {
        return Filiale::
            withCount(['clients as cli' => function($q){
                $q->whereHas('tipologia', function ($z){
                    $z->where('nome', 'CL');
                });
            }])
            ->withCount(['clients as pc' => function($q){
                $q->whereHas('tipologia', function ($z){
                    $z->where('nome', 'PC');
                });
            }])
            ->withCount(['clients as clc' => function($q){
                $q->whereHas('tipologia', function ($z){
                    $z->where('nome', 'CLC');
                });
            }])
            ->withCount(['clients as normo' => function($q){
                $q->whereHas('tipologia', function ($z){
                    $z->where('nome', 'NORMO');
                });
            }])
            ->withCount(['clients as le' => function($q){
                $q->whereHas('tipologia', function ($z){
                    $z->where('nome', 'LE');
                });
            }])
            ->withCount('clients as tot')
            ->orderBy('nome')
            ->get();
    }

    public function inviaMessaggio($request)
    {
        $utenti = $request->client;
        $messaggio = $request->testo;
        foreach ($utenti as $utente) {
            if($utente['mail']){
                \Mail::to($utente['mail'])->send(new inviaMessaggio($messaggio, $utente));
            }
        }
    }

    public function esisteDoppione($request)
    {
        return Client::where([
            ['nome', trim(Str::upper($request->nome))],
            ['cognome', trim(Str::upper($request->cognome))],
            ['citta', trim(Str::upper($request->citta))],
        ])->get();
    }

    private function getFilialeFromPlace($provincia, $citta)
    {
        $filiale = Filiale::where('provincia', $provincia)->get();

        if (count($filiale) == 1){
            return $filiale[0]->id;
        } else {
            if (in_array($citta, config('enum.civitanova'))) {
                return Filiale::where('nome', 'CIVITANOVA')->first()->id;
            } elseif (in_array($citta, config('enum.macerata'))) {
                return Filiale::where('nome', 'MACERATA')->first()->id;
            } elseif (in_array($citta, config('enum.pisa'))) {
                return Filiale::where('nome', 'PISA')->first()->id;
            } elseif (in_array($citta, config('enum.viareggio'))) {
                return Filiale::where('nome', 'VIAREGGIO')->first()->id;
            } elseif (in_array($citta, config('enum.lucca'))) {
                return Filiale::where('nome', 'LUCCA')->first()->id;
            } elseif (in_array($citta, config('enum.ascoli'))) {
                return Filiale::where('nome', 'ASCOLI')->first()->id;
            }
        }
    }

    public function cittaByProvincia($provincia)
    {
        return Client::where('provincia', $provincia)->orderBy('citta')->pluck('citta');
    }

    private function appuntamentoPresoRecentementeDaCallCenter($client){
        return Client::with(['appuntamenti' => function($r){
            $r->where('intervenuto', null);
        }])->where([
            ['nome', $client->nome],
            ['cognome', $client->cognome],
            ['citta', $client->citta],
        ])->whereHas('appuntamenti', function ($q){
            $q->where('intervenuto', null);
        })
            ->first();
    }

    private function copiaAnagrafica($clientInseritoDaCallCenter, $client){
        $clientInseritoDaCallCenter->nome = $client->nome;
        $clientInseritoDaCallCenter->cognome = $client->cognome;
        $clientInseritoDaCallCenter->created_at = $client->created_at;
        $clientInseritoDaCallCenter->updated_at = $client->updated_at;
        $clientInseritoDaCallCenter->citta = $client->citta;
        $clientInseritoDaCallCenter->indirizzo = $client->indirizzo;
        $clientInseritoDaCallCenter->provincia = $client->provincia;
        $clientInseritoDaCallCenter->telefono = $client->telefono;
        $clientInseritoDaCallCenter->telefono2 = $client->telefono2;
        $clientInseritoDaCallCenter->telefono3 = $client->telefono3;
        $clientInseritoDaCallCenter->cap = $client->cap;
        $clientInseritoDaCallCenter->datanascita = $client->datanascita;
        $clientInseritoDaCallCenter->recapito_id = $client->recapito_id;
        $clientInseritoDaCallCenter->mail = $client->mail;
        $clientInseritoDaCallCenter->tipologia_id = $client->tipologia_id;
        $clientInseritoDaCallCenter->marketing_id = $client->marketing_id;
        $clientInseritoDaCallCenter->filiale_id = $client->filiale_id;
        $clientInseritoDaCallCenter->mese = $client->mese;
        $clientInseritoDaCallCenter->anno = $client->anno;
        $clientInseritoDaCallCenter->save();
    }

    private function segnaAppuntamentoIntervenuto(Client $clientInseritoDaCallCenter)
    {
        $clientInseritoDaCallCenter->appuntamenti[0]->intervenuto = true;
        $clientInseritoDaCallCenter->push();
    }

    private function decriptazioneStruttura($codice)
    {
        $idFiliale = $idRecapito = null;
        if (isset($codice)){
            $letteraIniziale = Str::substr($codice, 0, 1);
            $id = Str::substr($codice, 1);
            if ($letteraIniziale === 'F')
            {
                $idFiliale = Filiale::find($id)->id;
                $idRecapito = null;
            } else if($letteraIniziale === 'R') {
                $recapito = Recapito::with('filiale')->find($id);
                $idRecapito = $recapito->id;
                $idFiliale = $recapito->filiale->id;
            }
        }

        return [$idFiliale, $idRecapito];
    }

    private function decriptazioneCodiceMarketing($codice)
    {
        $codiceDaRicercare = $codice;
        $idMedico = null;
        $letteraIniziale = Str::substr($codice, 0, 1);
        if ($letteraIniziale === 'M'){
            $codiceDaRicercare = 'M';
            $idMedico = Str::substr($codice, 1);
        }
        $marketing = Marketing::where('cod', $codiceDaRicercare)->first();
        return $marketing ? [$marketing->id, $idMedico] : [null, null];
    }

    private function inserisciRecallAutomatico($client, $idCliente)
    {
        if ($this->calcolaRecall($client->tipologia_id)){
            $telefonata = new Telefonata();
            $telefonata->user_id = $client->user_id;
            $telefonata->client_id = $idCliente;
            $telefonata->note = "recall automatico dell'inserimento paziente";
            $telefonata->datarecall = $this->calcolaRecall($client->tipologia_id);
            $telefonata->effettuata = false;
            $telefonata->save();
        }

    }

    private function inserisciOModificaClienteConDatiPassati($request, $client)
    {
        $idListaEsterna = Tipologia::where('nome', 'LE')->first()->id;

        $client->nome = trim(Str::upper($request->nome));
        $client->cognome = trim(Str::upper($request->cognome));
        $client->codfisc = trim(Str::upper($request->codfisc)) == '' ? null : trim(Str::upper($request->codfisc));
        $client->indirizzo = trim(Str::upper($request->indirizzo));
        $client->citta = trim(Str::upper($request->citta));
        $client->cap = $request->cap;
        $client->provincia = trim(Str::upper($request->provincia));
        $client->telefono = $request->telefono;
        $client->telefono2 = $request->telefono2;
        $client->telefono3 = $request->telefono3;
        $client->tipologia_id = $request->tipologia_id ? $request->tipologia_id : $idListaEsterna;
        $client->marketing_id = $request->marketing_id;
        $client->filiale_id = $request->filiale_id;
        $client->medico_id = $request->medico_id;
        $client->recapito_id = $request->recapito_id;
        $client->user_id = $request->user_id;
        $client->mail = trim(Str::upper($request->mail));
        $client->datanascita = $request->datanascita;
        $client->luogoNascita = trim(Str::upper($request->luogoNascita)) == '' ? null : trim(Str::upper($request->luogoNascita));
        $client->mesenascita = $request->datanascita ? Carbon::make($request->datanascita)->month : null;
        $client->giornonascita = $request->datanascita ? Carbon::make($request->datanascita)->day : null;
        $client->save();
    }

    private function inserisciMeseEdAnnoDiIngresso($client)
    {
        $client->mese = Carbon::now()->month;
        $client->anno = Carbon::now()->year;
        $client->save();
    }

    private function scriviSuLog($utente, $propieta, $client, $testo)
    {
        $log = new LoggingService();
        $log->scriviLog($client->cognome.' '.$client->nome, $utente, $utente->name, $propieta, $testo);
    }

    private function creaInformazione($client, $propieta, $testo)
    {
        Informazione::create([
            'client_id' => $client->id,
            'giorno' => Carbon::now()->format('Y-m-d'),
            'tipo' => $propieta,
            'note' => $testo
        ]);
    }

    private function calcolaRecall($tipologia_id)
    {
        $oggi = Carbon::now();
        $tipo = Tipologia::find($tipologia_id);
        return $tipo->recall ? $oggi->addDays($tipo->recall)->format('Y-m-d') : null;
    }

    private function inserimentoDatiDaFileXml($ele, $request, $idRecapito, $idMedico, $idCodMkt, $idFiliale, $idListaEsterna)
    {
        return Client::updateOrCreate(
            [
                'nome'          => trim(Str::upper($ele->Patient->FirstName)),
                'cognome'       => trim(Str::upper($ele->Patient->LastName)),
                'created_at'    => Carbon::make((string)$ele->Patient->CreateDate),
            ],
            [
                'citta'         => $ele->Patient->City ? trim(Str::upper($ele->Patient->City)) : null,
                'indirizzo'     => $ele->Patient->Address1 ? trim(Str::upper($ele->Patient->Address1)) : null,
                'cap'           => $ele->Patient->Zip ? trim(Str::upper($ele->Patient->Zip)) : null,
                'telefono'      => $ele->Patient->MobilePhone ? trim(Str::upper($ele->Patient->MobilePhone)) : null,
                'telefono2'     => $ele->Patient->WorkPhone ? trim(Str::upper($ele->Patient->WorkPhone)) : null,
                'telefono3'     => $ele->Patient->HomePhone ? trim(Str::upper($ele->Patient->HomePhone)) : null,
                'provincia'     => $ele->Patient->Country ? trim(Str::upper($ele->Patient->Country)) : null,
                'user_id'       => $request['idUser'],
                'datanascita'   => $ele->Patient->DateofBirth ? trim(Str::upper($ele->Patient->DateofBirth)) : null,
                'recapito_id'   => $idRecapito,
                'medico_id'     => $idMedico,
                'mail'          => $ele->Patient->EMail ? trim(Str::upper($ele->Patient->EMail)) : null,
                'tipologia_id'  => (string)$ele->Patient->Province != '' ? Tipologia::where('nome', trim(Str::upper($ele->Patient->Province)))->first()->id : $idListaEsterna,
                'marketing_id'  => $idCodMkt,
                'filiale_id'    => $idFiliale ? $idFiliale : $this->getFilialeFromPlace(Str::of(Str::upper($ele->Patient->Other1))->trim(),
                    Str::of(Str::upper($ele->Patient->City))->trim()),
                'updated_at'    => Carbon::make((string)$ele->Patient->CreateDate),
                'mese'          => Carbon::make((string)$ele->Patient->CreateDate)->month,
                'anno'          => Carbon::make((string)$ele->Patient->CreateDate)->year,
            ]
        );
    }

    private function verificaNonSiaDoppione($ele)
    {
        return Client::where([
            ['nome', trim(Str::upper($ele->Patient->FirstName))],
            ['cognome', trim(Str::upper($ele->Patient->LastName))],
            ['citta', trim(Str::upper($ele->Patient->City))],
            ['indirizzo', 'like', Str::substr(trim(Str::upper($ele->Patient->Address1)), 0, 8).'%'],
        ])->first();
    }

    private function inserisciElementoInListaOriginaliDaInserire($idDoppione, $ele, $request, $idRecapito, $idMedico, $idCodMkt, $idFiliale, $idListaEsterna)
    {
        $elemento = new \stdClass();
        $elemento->id = $idDoppione;
        $elemento->nome = trim(Str::upper($ele->Patient->FirstName));
        $elemento->cognome = trim(Str::upper($ele->Patient->LastName));
        $elemento->created_at = Carbon::make((string)$ele->Patient->CreateDate);
        $elemento->citta = trim(Str::upper($ele->Patient->City));
        $elemento->indirizzo = $ele->Patient->Address1 ? trim(Str::upper($ele->Patient->Address1)) : null;
        $elemento->cap = $ele->Patient->Zip ? trim(Str::upper($ele->Patient->Zip)) : null;
        $elemento->telefono = $ele->Patient->MobilePhone ? trim(Str::upper($ele->Patient->MobilePhone)) : null;
        $elemento->telefono2 = $ele->Patient->WorkPhone ? trim(Str::upper($ele->Patient->WorkPhone)) : null;
        $elemento->telefono3 = $ele->Patient->HomePhone ? trim(Str::upper($ele->Patient->HomePhone)) : null;
        $elemento->provincia = $ele->Patient->Country ? trim(Str::upper($ele->Patient->Country)) : null;
        $elemento->user_id = $request['idUser'];
        $elemento->datanascita = $ele->Patient->DateofBirth ? trim(Str::upper($ele->Patient->DateofBirth)) : null;
        $elemento->recapito_id = $idRecapito;
        $elemento->medico_id = $idMedico;
        $elemento->mail = $ele->Patient->EMail ? trim(Str::upper($ele->Patient->EMail)) : null;
        $elemento->tipologia_id = (string)$ele->Patient->Province != '' ? Tipologia::where('nome', trim(Str::upper($ele->Patient->Province)))->first()->id : $idListaEsterna;
        $elemento->marketing_id = $idCodMkt;
        $elemento->filiale_id = $idFiliale ? $idFiliale : $this->getFilialeFromPlace(Str::of(Str::upper($ele->Patient->Other1))->trim(),
            Str::of(Str::upper($ele->Patient->City))->trim());
        $elemento->updated_at = Carbon::make((string)$ele->Patient->CreateDate);
        $elemento->mese = Carbon::make((string)$ele->Patient->CreateDate)->month;
        $elemento->anno = Carbon::make((string)$ele->Patient->CreateDate)->year;
        return $elemento;
    }

    public function stampaNominativi($clientsResult)
    {
        return Excel::store(new ClientExport($clientsResult), 'nominativiFiltro.xlsx');
    }

}

<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Filiale;
use App\Models\Tipologia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function dd;
use function trim;

class ClientService
{
    public function index($idAudio)
    {

    }

    public function inserisci($request)
    {
        return Client::create([
            'nome' =>  trim(Str::upper($request->nome)),
            'cognome' =>  trim(Str::upper($request->cognome)),
            'codfisc' => trim(Str::upper($request->codfisc)) == '' ? null : trim(Str::upper($request->codfisc)),
            'indirizzo' => trim(Str::upper($request->indirizzo)),
            'citta' => trim(Str::upper($request->citta)),
            'cap' => trim($request->cap),
            'provincia' => trim(Str::upper($request->provincia)),
            'telefono' => trim($request->telefono),
            'user_id' => Auth::id(),
            'fonte' => trim(Str::upper($request->fonte)),
            'filiale_id' => $request->filiale_id,
            'recapito_id' => $request->recapito_id,
            'mail' => trim(Str::upper($request->mail)),
            'tipo' => $request->tipo,
            'recall' => 1,
            'datarecall' => $this->calcolaRecall($request->tipo),
            'datanascita' => $request->datanascita,
            'meseNascita' => $request->datanascita ? Carbon::make($request->datanascita)->month : null,
            'giornoNascita' => $request->datanascita ? Carbon::make($request->datanascita)->day : null,
        ]);
    }

    public function calcolaRecall($tipo)
    {
        $oggi = Carbon::now();
        $tipo = Tipologia::where('nome', $tipo)->first();
        return $oggi->addDays($tipo->recall)->format('Y-m-d');
    }

    public function modifica($request)
    {
        return Client::find($request->id)->update([
            'nome' =>  trim(Str::upper($request->nome)),
            'cognome' =>  trim(Str::upper($request->cognome)),
            'codfisc' => trim(Str::upper($request->codfisc)) == '' ? null : trim(Str::upper($request->codfisc)),
            'indirizzo' => trim(Str::upper($request->indirizzo)),
            'citta' => trim(Str::upper($request->citta)),
            'cap' => trim($request->cap),
            'provincia' => trim(Str::upper($request->provincia)),
            'telefono' => trim($request->telefono),
            'user_id' => Auth::id(),
            'fonte' => trim(Str::upper($request->fonte)),
            'filiale_id' => $request->filiale_id,
            'recapito_id' => $request->recapito_id,
            'mail' => trim(Str::upper($request->mail)),
            'tipo' => trim(Str::upper($request->tipo)),
            'datanascita' => $request->datanascita,
            'meseNascita' => $request->datanascita ? Carbon::make($request->datanascita)->month : null,
            'giornoNascita' => $request->datanascita ? Carbon::make($request->datanascita)->day : null,
        ]);

    }

    public function recall($request)
    {
        $client = Client::find($request->id_client);
        $client->recall = '1';
        $client->datarecall = $request->recall;
        return $client->save();
    }

    public function getClient($id)
    {
        return $id != '' ? Client::find($id) : null;
    }

    public function getProve($id)
    {
        /*dd(Client::with(['prova' => function ($q){
            $q->with(['product'])->orderBy('inizio_prova', 'asc');
        }])->find($id)->prova);*/

        return Client::with(['provaInCorso' => function ($q){
            $q->with(['product' => function($q){
                $q->with('listino');
            }])->orderBy('inizio_prova', 'asc');
        }])->find($id)->provaInCorso;
    }

    public function getRecallsOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Filiale::with(['clients' => function ($q) use($oggi){
            $q->where([['recall'],['datarecall', $oggi]]);
        }])->whereHas('clients', function($z) use($oggi){
            $z->where([['recall'],['datarecall', $oggi]]);
        })->get();
    }

    public function getRecallsDomani()
    {
        $domani = Carbon::tomorrow()->format('Y-m-d');

        return Filiale::with(['clients' => function ($q) use($domani){
            $q->where([['datarecall', $domani]]);
        }])->whereHas('clients', function($z) use($domani){
            $z->where([['datarecall', $domani]]);
        })->get();
    }

    public function inserisciCodfisc($id, $codfisc)
    {
        $client = Client::find($id);
        $client->codfisc = $codfisc;
        return $client->save();
    }

    public function compleanniOggi()
    {
        $meseOggi = Carbon::now()->month;
        $giornoOggi = Carbon::now()->day;
        return User::with(['client' => function($q) use($meseOggi, $giornoOggi) {
            $q->compleanno($meseOggi, $giornoOggi);
        }])->find(Auth::id())->client;
    }
}

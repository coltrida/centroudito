<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Filiale;
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
            'tipo' => trim(Str::upper($request->tipo))
        ]);
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
            'tipo' => trim(Str::upper($request->tipo))
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

        return Client::with(['prova' => function ($q){
            $q->with(['product'])->orderBy('inizio_prova', 'asc');
        }])->find($id)->prova;
    }

    public function getRecallsOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return Filiale::with(['clients' => function ($q) use($oggi){
            $q->where([['recall', '1'],['datarecall', $oggi]]);
        }])->whereHas('clients', function($z) use($oggi){
            $z->where([['recall', '1'],['datarecall', $oggi]]);
        })->get();
    }

    public function getRecallsDomani()
    {
        $domani = Carbon::tomorrow()->format('Y-m-d');
        return Filiale::with(['clients' => function ($q) use($domani){
            $q->where([['recall', '1'],['datarecall', $domani]]);
        }])->whereHas('clients', function($z) use($domani){
            $z->where([['recall', '1'],['datarecall', $domani]]);
        })->get();
    }
}

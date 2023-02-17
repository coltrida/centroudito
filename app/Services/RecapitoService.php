<?php


namespace App\Services;


use App\Models\Recapito;
use App\Models\User;
use Illuminate\Support\Str;
use function trim;

class RecapitoService
{
    public function lista()
    {
        return Recapito::orderBy('nome')->get();
    }

    public function struttureAudio($idAudio)
    {
        $recapiti = User::with('recapito:id,nome,citta,user_id,codiceIdentificativo')->find($idAudio)->recapito;
        $recapiti->each(function ($item){
            $item->tipologia = 'recapito';
        });

        $filiali = User::with('filiale:id,nome,citta,codiceIdentificativo')->find($idAudio)->filiale;
        $filiali->each(function ($item){
            $item->tipologia = 'negozio';
        });

        return $filiali->concat($recapiti);
    }

    public function listaPerAudio()
    {
        return User::audio()->with(['recapito' => function($recapito){
            $recapito->orderBy('provincia');
        }])->orderBy('name')->get();
    }

    public function recapitiByAudio($idAudio)
    {
        return User::with('recapito')->find($idAudio)->recapito;
    }

    public function aggiungi($request)
    {
        $recapito = Recapito::create([
            'nome' => trim(Str::upper($request->nome)),
            'indirizzo' => $request->indirizzo != 'undefined' ? trim(Str::upper($request->indirizzo)) : null,
            'citta' => $request->citta != 'undefined' ? trim(Str::upper($request->citta)) : null,
            'telefono' => $request->telefono != 'undefined' ? $request->telefono : null,
            'user_id' => $request->user_id,
            'provincia' => $request->provincia != 'undefined' ? trim(Str::upper($request->provincia)) : null,
            'informazioni' => $request->informazioni != 'undefined' ? trim(Str::upper($request->informazioni)) : null,
        ]);

        if($request->hasfile('file')) {
            $this->salvaFoto($request, $recapito);
        }

        $recapito->codiceIdentificativo = 'R'.$recapito->id;
        $recapito->save();

        return $recapito;
    }

    public function modifica($request)
    {
        $recapito = Recapito::find($request->id);
        $recapito->nome = trim(Str::upper($request->nome));
        $recapito->indirizzo = $request->indirizzo != 'undefined' ? trim(Str::upper($request->indirizzo)) : null;
        $recapito->citta = $request->citta != 'undefined' ? trim(Str::upper($request->citta)) : null;
        $recapito->telefono = $request->telefono != 'undefined' ? $request->telefono : null;
        $recapito->user_id = $request->user_id;
        $recapito->provincia = $request->provincia != 'undefined' ? trim(Str::upper($request->provincia)) : null;
        $recapito->informazioni = $request->informazioni != 'undefined' ? trim(Str::upper($request->informazioni)) : null;
        $recapito->save();

        if($request->hasfile('file')) {
            $this->salvaFoto($request, $recapito);
        }

        return $recapito;
    }

    public function elimina($id)
    {
        return Recapito::find($id)->delete();
    }

    public function strutture($idAudio)
    {
        $recapiti = User::with('recapito:id,codiceIdentificativo,nome,user_id,informazioni,indirizzo,citta')->find($idAudio)->recapito;
        foreach ($recapiti as $recapito){
            $recapito->nome = 'Recapito - '.$recapito->nome;
        }
        $filiali = User::with('filiale:id,codiceIdentificativo,nome,informazioni,indirizzo,citta')->find($idAudio)->filiale;
        foreach ($filiali as $filiale){
            $filiale->nome = 'Filiale - '.$filiale->nome;
        }

        return $recapiti->concat($filiali);
    }

    private function salvaFoto($request, $recapito)
    {
        $file = $request->file('file');
        $filename = 'R'.$recapito->id.'.jpg';
        $path = 'recapiti/'.$request->fileName;
        \Storage::disk('public')->putFileAs($path, $file, $filename);
    }
}

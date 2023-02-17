<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use Illuminate\Support\Str;

class FilialeService
{
    public function lista()
    {
        return Filiale::orderBy('nome')->get();
    }

    public function filialiAudio($idAudio)
    {
        return User::with('filiale')->find($idAudio)->filiale;
    }

    public function aggiungi($request)
    {
        $filiale = Filiale::create([
            'nome' => trim(Str::upper($request->nome)),
            'indirizzo' => trim(Str::upper($request->indirizzo)),
            'citta' => trim(Str::upper($request->citta)),
            'telefono' => $request->telefono,
            'cap' => $request->cap,
            'provincia' => trim(Str::upper($request->provincia)),
            'informazioni' => trim(Str::upper($request->informazioni)),
        ]);

        if($request->hasfile('file')) {
            $this->salvaFoto($request, $filiale);
        }

        $filiale->codiceIdentificativo = 'F'.$filiale->id;
        $filiale->save();

        return $filiale;
    }

    public function modifica($request)
    {
        $filiale = Filiale::find($request->id);
        $filiale->nome = trim(Str::upper($request->nome));
        $filiale->indirizzo = trim(Str::upper($request->indirizzo));
        $filiale->citta = trim(Str::upper($request->citta));
        $filiale->telefono = $request->telefono;
        $filiale->cap = $request->cap;
        $filiale->provincia = trim(Str::upper($request->provincia));
        $filiale->informazioni = trim(Str::upper($request->informazioni));
        $filiale->save();

        if($request->hasfile('file')) {
            $this->salvaFoto($request, $filiale);
        }

        return $filiale;
    }

    public function elimina($id)
    {
        return Filiale::find($id)->delete();
    }

    public function associazioni()
    {
        return Filiale::with('users:id,name')->orderBy('nome')->get();
    }

    public function situazioneMese()
    {
        return Filiale::with('audioprot')->orderBy('nome')->get();
    }

    public function aggiungiAssociazione($request)
    {
        foreach($request->Audio as $audio){
            FilialeUser::create([
                'user_id' => $audio['id'],
                'filiale_id' => $request->idFiliale,
            ]);
            /*$associazione = new FilialeUser();
            $associazione->user_id = $audio['id'];
            $associazione->filiale_id = $request->idFiliale;
            $associazione->save();*/
        }

        foreach($request->Amm as $amm){
            FilialeUser::create([
                'user_id' => $amm['id'],
                'filiale_id' => $request->idFiliale,
            ]);
            /*$associazione = new FilialeUser();
            $associazione->user_id = $amm['id'];
            $associazione->filiale_id = $request->idFiliale;
            $associazione->save();*/
        }

        return Filiale::with('users:id,name')->orderBy('nome')->get();
    }

    public function eliminaAssociazione($id)
    {
        FilialeUser::find($id)->delete();
        return Filiale::with('users:id,name')->orderBy('nome')->get();
    }

    public function filialeById($idFiliale)
    {
        return Filiale::find($idFiliale);
    }

    private function salvaFoto($request, $filiale)
    {
        $file = $request->file('file');
        $filename = 'F'.$filiale->id.'.jpg';
        $path = 'recapiti/'.$request->fileName;
        \Storage::disk('public')->putFileAs($path, $file, $filename);
    }

}

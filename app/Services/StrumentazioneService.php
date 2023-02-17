<?php


namespace App\Services;


use App\Models\Filiale;
use App\Models\Strumentazione;
use Illuminate\Support\Str;
use function trim;

class StrumentazioneService
{
    public function nonAssociata()
    {
        return Strumentazione::where([
            ['user_id', null],
            ['medico_id', null],
            ['filiale_id', null],
        ])->orderBy('nome')->get();
    }

    public function associata()
    {
        return Filiale::with(['strumentazione' => function($s){
            $s->with('medico', 'user');
        }])->orderBy('nome')->get();
    }

    public function modifica($request)
    {
        $new = Strumentazione::find($request->id);

        $new->nome = trim(Str::upper($request->nome));
        $new->matricola = trim(Str::upper($request->matricola));
        $new->fornitore = trim(Str::upper($request->fornitore));
        $new->save();

        return $new;
    }

    public function aggiungi($request)
    {
        return Strumentazione::create([
            'nome' => trim(Str::upper($request->nome)),
            'matricola' => trim(Str::upper($request->matricola)),
            'fornitore' => trim(Str::upper($request->fornitore)),
        ]);
    }

    public function elimina($id)
    {
        return Strumentazione::find($id)->delete();
    }

    public function associaStrumentazione($request)
    {
        $idStrumento = $request->id[0]['id'];
        $idFiliale = isset($request->filiale_id[0]) ? $request->filiale_id[0]['id'] : null;
        $idUser = isset($request->user_id[0]) ? $request->user_id[0]['id'] : null;
        $idMedico = isset($request->medico_id[0]) ? $request->medico_id[0]['id'] : null;

        $strumento = Strumentazione::find($idStrumento);
        $strumento->user_id = $idUser;
        $strumento->medico_id = $idMedico;
        $strumento->filiale_id = $idFiliale;
        $strumento->save();

        return Strumentazione::with('filiale', 'medico', 'user')->find($idStrumento);
    }

    public function dissociaStrumentazione($id)
    {
        $strumento = Strumentazione::find($id);
        $filialeId = $strumento->filiale_id;
        $strumento->user_id = null;
        $strumento->filiale_id = null;
        $strumento->medico_id = null;
        $strumento->save();
        $stru = Strumentazione::with('filiale', 'medico', 'user')->find($id);
        $stru->filTrans = $filialeId;
        return $stru;
    }
}

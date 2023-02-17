<?php


namespace App\Services;


use App\Models\Listino;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ListinoService
{
    public function listino()
    {
        return Listino::with(['categoria', 'filiale' => function($f){
            $f->orderBy('nome');
        }, 'fornitore:id,nome'])
            ->orderBy('fornitore_id')
            ->orderBy('categoria_id')
            ->orderBy('nome')
            ->get();
    }

    public function listinoFromFornitore($idFornitore)
    {
        return Listino::fromfornitore($idFornitore)->orderBy('categoria_id')->get();
    }

    public function listinoFromId($idListino)
    {
        return Listino::find($idListino);
    }

    public function inserisci($request)
    {
        //dd($request->idFiliale);

        $listino = Listino::create([
            'categoria_id' => $request['categoria_id'],
            'nome' => trim(Str::upper($request['nome'])),
            'costo' => $request['costo'],
            'giorniTempoDiReso' => trim(Str::upper($request['giorniTempoDiReso'])),
            'fornitore_id' => $request['fornitore_id'],
            'scontoMax' => $request['scontoMax'],
            'prezzolistino' => trim(Str::upper($request['prezzolistino'])),
            'iva' => $request['iva']
        ]);

        for ($i=0; $i < count($request->soglie); $i++){
            if ($request->soglie[$i] != null){
                $listino->filiale()->attach($request->idFiliali[$i], ['soglia' => $request->soglie[$i]]);
            }
        }

        $type = 'string';
        Schema::table('ventaglios', function (Blueprint $table) use ($type, $listino) {
            $table->$type(str_replace(' ', '', $listino->nome))->default(0);
        });

        return Listino::with(['categoria', 'filiale' => function($f){
            $f->orderBy('nome');
        }, 'fornitore:id,nome'])->find($listino->id);
    }

    public function modifica($request)
    {
        $listino = Listino::find($request['id']);
        $vecchioNome = $listino->nome;
        $nuovoNome = trim(Str::upper($request['nome']));
        //dd($request);
        $listino->categoria_id = $request['categoria_id'];
        $listino->nome = $nuovoNome;
        $listino->costo = $request['costo'];
        $listino->giorniTempoDiReso = trim(Str::upper($request['giorniTempoDiReso']));
        $listino->fornitore_id = $request['fornitore_id'];
        $listino->scontoMax = $request['scontoMax'];
        $listino->prezzolistino = trim(Str::upper($request['prezzolistino']));
        $listino->iva = $request['iva'];
        $listino->save();

       // $listino->filiale()->updateExistingPivot($request->idFiliali[$i], $request->soglie[$i]);

        for ($i=0; $i < count($request->soglie); $i++){
            if ($request->soglie[$i] != null){
                $listino->filiale()->updateExistingPivot($request->idFiliali[$i], [
                    'soglia' => $request->soglie[$i]
                ]);
            }
        }

        $nuovoNome = Str::replace(' ', '', $nuovoNome);

        if ($vecchioNome != $nuovoNome){
            Schema::table('ventaglios', function (Blueprint $table) use ($vecchioNome, $nuovoNome) {
                $table->renameColumn($vecchioNome, $nuovoNome);
            });
        }


        return Listino::with(['categoria', 'filiale' => function($f){
            $f->orderBy('nome');
        }, 'fornitore:id,nome'])->find($listino->id);
    }

    public function rimuovi($id)
    {
        return Listino::find($id)->delete();
    }

    public function nomiApa()
    {
        $nomi = [];
        $list = Listino::apparecchi()->pluck('nome');
        foreach ($list as $ele){
            array_push($nomi, str_replace(' ', '', $ele));
        }
        return $nomi;
    }
}

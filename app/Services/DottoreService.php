<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Marketing;
use App\Models\Medico;
use App\Models\OrarioMedico;
use App\Models\StatoApa;
use App\Models\Tipologia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function trim;

class DottoreService
{
    public function lista($idUser)
    {
        return $idUser ?
            User::with(['medici' => function($m){
                $m->orderBy('cognome');
            }])->find($idUser)->medici :
            Medico::with('user')->orderBy('cognome')->get();
    }

    public function caricaOrari($idDottore)
    {
        return Medico::with('orari')->find($idDottore)->orari;
    }

    public function caricaOrarioDottore($dottore)
    {
        $idDottore = Medico::where('nome', $dottore)->first()->id;
        return $this->caricaOrari($idDottore);
    }

    public function aggiungi($request)
    {
        $new = Medico::firstOrCreate([
            'nome' => trim(Str::upper($request->nome)),
            'cognome' => trim(Str::upper($request->cognome)),
        ]);

        $new->user()->attach($request->userId);

        $newOtorino = Medico::with('user')->find($new->id);
        $newOtorino->cod = 'M'.$new->id;
        $newOtorino->save();

        return $newOtorino;
    }

    public function elimina($idMedico)
    {
        return Medico::find($idMedico)->delete();
    }

    public function aggiungiOrario($request)
    {
        return OrarioMedico::create([
            'medico_id' => $request->idDottore,
            'dove' => $request->dove,
            'giorno' => $request->giorno,
            'orario' => $request->orario,
        ]);
    }

    public function eliminaOrario($idOrario)
    {
        return OrarioMedico::find($idOrario)->delete();
    }

    public function inviiMedici($request)
    {
        $idMktMedico = Marketing::where('name', 'MEDICO')->first()->id;
        return User::
            with(['client' => function($c) use($request, $idMktMedico){
                $c->where([
                    ['anno', $request->anno],
                    ['marketing_id', $idMktMedico],
                ])->with('prova', 'medico')->orderBy('medico_id');
        }])
        ->find($request->idUser)->client;
    }

    public function totaleInviiMedici($request)
    {
        $idTipologiaVendita = StatoApa::where('nome', 'FATTURA')->first()->id;
        return User::
        with(['medici' => function($m) use($request, $idTipologiaVendita){
            $m->withCount(['clients as vendite' => function($c) use($request, $idTipologiaVendita){
                $c->whereHas('prova', function ($p) use($request, $idTipologiaVendita){
                    $p->where([
                        ['anno_fine', $request->anno],
                        ['stato_id', $idTipologiaVendita],
                    ]);
                });
            }])
                ->withCount(['clients as invii' => function($q) use($request) {
                    $q->where('anno', $request->anno);
                }])
            ->orderBy('cognome');
        }])
        ->find($request->idUser)->medici;
    }

    public function statisticheInviiMedici($request)
    {
        $idMktMedico = Marketing::where('name', 'MEDICO')->first()->id;
        return Client::where([
            ['marketing_id', $idMktMedico],
            ['anno', $request->anno],
        ])
            ->with(['prova' => function($k){
                $k->with('stato');
            }, 'medico', 'user'])
            ->orderBy('user_id')->orderBy('medico_id')->get();
    }

    public function statisticheTotaleInviiMedici($request)
    {
        $idVendita = StatoApa::where('nome', 'FATTURA')->first()->id;
        return Medico::
        withCount(['clients as vendite' => function($q) use($request, $idVendita) {
            $q->whereHas('prova', function ($q) use($request, $idVendita){
                $q->where([
                    ['anno_fine', $request->anno],
                    ['stato_id', $idVendita],
                ]);
            });
        }])
            ->withCount(['clients as invii' => function($g) use($request){
                $g->where('anno', $request->anno);
            }])
            ->withSum('prova', 'tot')->orderBy('cognome')->get();
    }

    public function statisticheMensiliMedici($request)
    {
        $annoOggi = $request->anno;
        return Medico::
            with('user')
            ->withcount(['clients' => function($q) use($annoOggi){
                $q->where('anno', $annoOggi);
            }])
            ->withCount(['clients as gen' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 1]
                ]);
            }])
            ->withCount(['clients as feb' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 2]
                ]);
            }])
            ->withCount(['clients as mar' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 3]
                ]);
            }])
            ->withCount(['clients as apr' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 4]
                ]);
            }])
            ->withCount(['clients as mag' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 5]
                ]);
            }])
            ->withCount(['clients as giu' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 6]
                ]);
            }])
            ->withCount(['clients as lug' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 7]
                ]);
            }])
            ->withCount(['clients as ago' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 8]
                ]);
            }])
            ->withCount(['clients as set' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 9]
                ]);
            }])
            ->withCount(['clients as ott' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 10]
                ]);
            }])
            ->withCount(['clients as nov' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 11]
                ]);
            }])
            ->withCount(['clients as dic' => function($q) use($annoOggi){
                $q->where([
                    ['anno', $annoOggi], ['mese', 12]
                ]);
            }])
            ->orderBy('nome')
            ->get();
    }
}

<?php


namespace App\Services;


use App\Events\LogisticaEvent;
use App\Models\Ddt;
use App\Models\Filiale;
use App\Models\Listino;
use App\Models\Product;
use App\Models\Richiesta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Storage;
use function array_push;
use function create_function;
use function dd;

class ProductService
{
    public function riepilogoFiliali()
    {
        $filiali = Filiale::select(['id','nome'])
            ->withCount('productsPresenti')
            ->withCount('productsInProva')
            ->withCount('productsRichiesti')
            ->withCount('productsInArrivo')
            ->orderBy('nome')
            ->get();

        $filiali->push([
            'id' => count($filiali)+1,
            'nome' => 'CENTRALE',
            'products_presenti_count' => Product::where([['stato_id', 8], ['filiale_id', 0]])->count(),
            'products_in_prova_count' => 0,
            'products_richiesti_count' => 0,
            'products_in_arrivo_count' => 0,

        ]);

        return $filiali;
    }

    public function inCentrale()
    {
        return Product::where([
            ['stato_id', 8],
            ['filiale_id', 0],
        ])
            ->orderBy('fornitore_id')->orderBy('listino_id')
            ->get();
    }

    public function riepilogoInCentrale()
    {
        $elementiDistinti = Product::select('listino_id')->with('listino')->where([
            ['filiale_id', 0],
            ['stato_id', 8],
        ])->distinct()->get();



        foreach ($elementiDistinti as $item){
            $item->nome = $item->listino->nome;
            $item->totPresenti = Product::where([
                ['filiale_id', 0],
                ['stato_id', 8],
                ['listino_id', $item->listino_id],
            ])->count();
        }
       // dd($elementiDistinti);
        return $elementiDistinti;
    }

    public function aggiungiProductInCentrale($request)
    {
        $propieta = 'product';
        $prodotto = Listino::find($request->listino_id);
        $utente = User::find($request->user_id);
        $testo = $utente->name.' ha inserito '.$prodotto->nome .' con matricola '.$request->matricola.' nel magazzino centrale ';
        $log = new LoggingService();
        $log->scriviLog('CENTRALE', $utente, $utente->name, $propieta, $testo);

        return Product::create([
            'matricola' => $request->matricola,
            'stato_id' => $request->stato_id,
            'listino_id' => $request->listino_id,
            'fornitore_id' => $request->fornitore_id,
            'filiale_id' => $request->filiale_id,
            'datacarico' => Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function presenti($id)
    {
        $nomeFiliale = Filiale::find($id)->nome;
        return Filiale::with(['products' => function($q) use($nomeFiliale){
            $q->with(['listino' => function($l) use($nomeFiliale){
                $l->with(['fornitore', 'categoria','filiale' => function($h) use($nomeFiliale){
                    $h->where('nome', $nomeFiliale);
                }]);
            }])->filiale()->orderBy('listino_id');
        }])->find($id)->products;
    }

    public function controlloSoglie($id)
    {
        $soglie = [];
        $nomeFiliale = Filiale::find($id)->nome;

        $conteggi = Product::
        where('filiale_id', $id)
            ->filiale()
            ->get()
            ->countBy('listino_id');

        $listino = Listino::
            with(['filiale' => function($e) use($nomeFiliale){
                $e->where('nome', $nomeFiliale);
        }])
            ->whereHas('product', function ($stato) use($id){
                $stato->where('filiale_id', $id)->filiale();
        })->orderBy('id')->get();

        for ($i = 0; $i < count($listino); $i++){
            $idListino = $listino[$i]->id;
            $soglie[$i]['nome'] = $listino[$i]->nome;
            $soglie[$i]['soglia'] = $listino[$i]->filiale[0]->pivot->soglia;
            $soglie[$i]['conteggio'] = $conteggi["$idListino"];
        }

        return $soglie;

    }

    public function presentiFromFornitore($idFiliale, $idFornitore)
    {
        return Filiale::with(['products' => function($q) use($idFornitore){
            $q->with(['listino' => function($l){
                $l->with('fornitore', 'categoria');
            }])->filiale()->where('fornitore_id', $idFornitore)->orderBy('listino_id');
        }])->find($idFiliale)->products;
    }

    public function inProva($id)
    {
        return Filiale::with(['products' => function($q){
            $q->with(['client','listino' => function($l){
                $l->with('fornitore', 'categoria');
            }])->prova()->orderBy('listino_id');
        }])->find($id)->products;
    }

    public function richiesti($id)
    {
        /*return Filiale::with(['products' => function($q){
            $q->with(['listino' => function($l){
                $l->with('fornitore', 'categoria');
            }])->richiesto()->orderBy('listino_id');
        }])->find($id)->products;*/

        return Filiale::with(['richieste' => function($r){
            $r->with(['listino' => function($l){
                $l->with('fornitore');
            }]);
        }])->find($id)->richieste;
    }

    public function inArrivo($id)
    {
        return Filiale::with(['products' => function($q){
            $q->with(['listino' => function($l){
                $l->with('fornitore', 'categoria');
            }])->arrivo()->orderBy('listino_id');
        }])->find($id)->products;
    }

    public function richiestaProdotti($request)
    {
        $richiestaSalvata = Richiesta::create([
            'filiale_id' => $request->filiale_id,
            'listino_id' => $request->listino_id,
            'quantita' => $request->quantita,
        ]);

        $richiesta = Richiesta::with(['listino' => function($l){
            $l->with('fornitore');
        }, 'filiale'])->find($richiestaSalvata->id);

        $propieta = 'product';
        $filiale = $richiesta->filiale;
        $prodotto = $richiesta->listino;
        $utente = User::find($request->user_id);
        $testo = $utente->name.' ha richiesto '.$request->quantita. ' '. $prodotto->nome .' per la filiale '.$filiale->nome;
        $log = new LoggingService();
        $log->scriviLog($filiale->nome, $utente, $utente->name, $propieta, $testo);

        broadcast(new LogisticaEvent($richiesta))->toOthers();
        return $richiesta;
    }

    public function assegnaProdottiMagazzino($request)
    {
        $idDDT = $this->creaDDT($request->prodotti);

        foreach ($request->prodotti as $item) {
            $prodotto = Product::find($item['id']);
            $prodotto->stato_id = 1;
            $prodotto->ddt_id = $idDDT;
            $prodotto->save();
        };
        broadcast(new LogisticaEvent($request->prodotti))->toOthers();
    }

    public function annullaProdottiMagazzino($request)
    {
        foreach ($request->prodotti as $item){
            $prodotto = Product::find($item['id']);
            $prodotto->filiale_id = 0;
            $prodotto->save();
        }
    }

    public function creaDDT($request)
    {
       // dd($request['filiale_id']);
        $filiale = Filiale::find($request['filiale_id']);

        $nuovoDDT = Ddt::create([
            'filiale_id' => $request['filiale_id'],
            'progressivo' => $this->calcolaProgressivoDdt(),
            'nome_destinazione' => 'Centro Udito '.$filiale->citta,
            'indirizzo_destinazione' => $filiale->indirizzo,
            'citta_destinazione' => $filiale->citta,
            'cap_destinazione' => $filiale->cap,
            'provincia_destinazione' => $filiale->provincia,
            'anno' => Carbon::now()->year,
            'mese' => Carbon::now()->month,
        ]);

        $this->produciPdfDdt($nuovoDDT, $request);

        return $nuovoDDT->id;
    }

    public function switchInProva($request)
    {
        $product = Product::find($request->idProduct);
        $product->stato_id = 3;
        $product->user_id = $request->user_id;
        $product->client_id = $request->client_id;
        $product->save();
    }

    public function switchImmatricolato($request)
    {
        $product = Product::find($request->idProduct);
        $product->stato_id = 8;
        $product->matricola = $request->matricola;
        $product->save();
    }

    public function switchRimuoviDallaProva($id)
    {
        $product = Product::find($id);
        $product->stato_id = 5;
        $product->user_id = null;
        $product->client_id = null;
        $product->save();
    }

    public function productRimuoviRichiesta($id)
    {
        $richiesta = Richiesta::find($id);
        broadcast(new LogisticaEvent($richiesta))->toOthers();
        $richiesta->delete();
    }

    public function listaProdottiRichiesti()
    {
        return Filiale::with(['productsRichiesti' => function($q){
                $q->with(['listino' => function($d){
                    $d->with('fornitore');
                }])->orderBy('listino_id');
            }])
            ->whereHas('productsRichiesti')
            ->get();
    }

    public function prodottiImmatricolati($idFiliale)
    {
        return Filiale::with(['productsImmatricolati' => function($q){
            $q->with(['listino' => function($d){
                $d->with('fornitore');
            }])->orderBy('listino_id');
        }])->find($idFiliale)->productsImmatricolati;
    }

    public function switchArrivato($id)
    {
        $product = Product::with(['listino' => function($d){
            $d->with('fornitore');
        }])
            ->find($id);
        $product->stato_id = 5;
        $product->datacarico = Carbon::now()->format('Y-m-d');
        $product->save();
        return $product;
    }

    public function servizi()
    {
        return Listino::with('fornitore', 'categoria')->whereHas('categoria', function ($q){
            $q->where('nome', 'SERV');
        })->orderBy('nome')->get();
    }

    public function assegnaProdottiToFiliale($request)
    {
        foreach ($request['prodotti'] as $item) {
            $prodotto = Product::find($item['id']);
            $this->aggiornaRichiestaFiliale($prodotto->listino_id, $request['filiale_id']);
            $prodotto->stato_id = 8;
            $prodotto->filiale_id = $request['filiale_id'];
            $prodotto->save();
        };
    }

    public function confermaProdottiToFiliale($request)
    {
        $idDDT = $this->creaDDT($request);
        foreach ($request['prodotti'] as $item) {
            $prodotto = Product::find($item['id']);
            $prodotto->stato_id = 1;
            $prodotto->ddt_id = $idDDT;
            $prodotto->save();
        };
        broadcast(new LogisticaEvent($request->prodotti))->toOthers();
    }

    public function richiesteFiliali()
    {
        return Filiale::whereHas('richieste')->with(['richieste' => function($r){
            $r->with(['listino' => function($l){
                $l->with('fornitore');
            }])->orderBy('listino_id');
        }])->get();
    }

    public function eliminaProduct($id)
    {
        Product::destroy($id);
    }

    public function listaDdt($request)
    {
        return Ddt::where('anno', $request->anno)->with(['products' => function($p){
            $p->with('listino', 'fornitore');
        }])->latest()->get();
    }

    private function aggiornaRichiestaFiliale($idListino, $idFiliale)
    {
        $richiesta = Richiesta::where([
            ['filiale_id', $idFiliale],
            ['listino_id', $idListino],
        ])->first();
        if ($richiesta){
            $richiesta->quantita -= 1;
            $richiesta->save();
            if ($richiesta->quantita === 0) {
                $richiesta->delete();
            }
        }
    }

    private function calcolaProgressivoDdt()
    {
        $anno = Carbon::now()->year;
        $ddtAnno = Ddt::where('anno', $anno)->count();
        return ($ddtAnno + 1);
    }

    private function produciPdfDdt($nuovoDDT, $request)
    {
        $prodotti = $request->prodotti;
        //dd($prodotti);
        $pdf = App::make('dompdf.wrapper');
        if (!Storage::disk('public')->exists('/ddt/')) {
            Storage::makeDirectory('/ddt/');
        }
        $pdf->loadHTML(view('pdf.ddt', compact('nuovoDDT', 'prodotti')))
            ->save("storage/ddt/".$nuovoDDT->id.'.pdf');
    }
}

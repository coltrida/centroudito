<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-4">
                <p class="font-bold text-lg ">Finalizzati nel mese</p>
                <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                    <div class="row justify-between my-1 align-items-center">
                        <div class="col">
                            <div class="font-bold">Budget del mese: € {{ ( (int)$budget->budgetAnno * (int)$budget->target ) / 100 }}</div>
                        </div>
                    </div>
                </div>
                @foreach($finalizzati as $prova)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">Finalizzato il: {{$prova->fine_prova}}</div>
                                <div class="text-right">Cliente:
                                    <span class="badge bg-warning text-dark">
                                            {{$prova->client->nome}} {{$prova->client->cognome}}
                                        </span>
                                </div>
                                <div>{{$prova->client->indirizzo}} - {{$prova->client->citta}} - {{$prova->client->provincia}}</div>
                                @foreach($prova->product as $product)
                                    <div class="row" >
                                        <div class="col">matricola: {{$product->matricola}}</div>
                                        <div class="col"> {{$product->listino->nome}}</div>
                                    </div>
                                @endforeach
                                <div class="font-bold text-right">Tot:
                                    <span class="badge bg-warning text-dark">
                                            € {{$prova->tot}}
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg ">Prove In corso</p>
                @foreach($proveInCorso as $prova)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">Giorni in Prova: {{$prova->giorniInProva}}</div>
                                <div >
                                    <div class="text-right">Cliente:
                                        <span class="badge bg-warning text-dark">
                                            {{$prova->client->nome}} {{$prova->client->cognome}}
                                        </span>
                                    </div>
                                    <div>{{$prova->client->indirizzo}} - {{$prova->client->citta}} - {{$prova->client->provincia}}</div>
                                    @foreach($prova->product as $product)
                                        <div class="row" >
                                            <div class="col">matricola: {{$product->matricola}}</div>
                                            <div class="col"> {{$product->listino->nome}}</div>
                                        </div>
                                    @endforeach
                                    <div class="font-bold text-right">Tot:
                                        <span class="badge bg-warning text-dark">
                                            € {{$prova->tot}}
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-success" wire:click="$emit('clientFattura', {{$prova->id}})"
                                               title="vendita"
                                               style="box-shadow: 2px 2px 4px #000000;"
                                            >
                                                VENDITA
                                                <i class="fas fa-check-square " ></i>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-danger" wire:click="reso({{$prova->id}})"
                                               title="reso"
                                               style="box-shadow: 2px 2px 4px #000000;"
                                            >
                                                RESO
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg ">Appuntamenti di Oggi</p>
                @foreach($appuntamentiOggi as $appuntamento)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$appuntamento->client->nome}} {{$appuntamento->client->cognome}}</div>
                                <div class="text-right">
                                    <div>{{$appuntamento->orario}}</div>
                                    @if($appuntamento->filiale_id)<div>{{$appuntamento->filiale->nome}}</div>@endif
                                    @if($appuntamento->recapito_id)<div>{{$appuntamento->recapito->nome}}</div>@endif
                                    <div>{{$appuntamento->nota}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <p class="font-bold text-lg ">Appuntamenti di Domani</p>
                @foreach($appuntamentiDomani as $appuntamento)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$appuntamento->client->nome}} {{$appuntamento->client->cognome}}</div>
                                <div class="text-right">
                                    <div>{{$appuntamento->orario}}</div>
                                    @if($appuntamento->filiale_id)<div>{{$appuntamento->filiale->nome}}</div>@endif
                                    @if($appuntamento->recapito_id)<div>{{$appuntamento->recapito->nome}}</div>@endif
                                    <div>{{$appuntamento->nota}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


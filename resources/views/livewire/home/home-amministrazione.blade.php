<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @if (session()->has('message'))
        <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-7">
                <p class="font-bold text-lg ">Prodotti Richiesti da Filiali</p>


                <div class="accordion" id="accordionExample">
                    @foreach($FilialiprodottiRichiesti as $filiale)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$filiale->nome}}" aria-expanded="false" aria-controls="collapseOne">
                                Filiale: {{$filiale->nome}}
                            </button>
                        </h2>

                        <div id="collapseOne{{$filiale->nome}}" class="accordion-collapse collapse @if ($aperto[$filiale->id] == 'true') show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                                    @foreach($filiale->products as $item)
                                        <div class="row justify-between my-1 align-items-center">
                                            <div class="col">
                                                {{$item->fornitore->nome}}
                                            </div>
                                            <div class="col">
                                                {{$item->listino->nome}}
                                            </div>
                                            <div class="col">
                                                {{$item->created_at->format('d/m/Y')}}
                                            </div>
                                            <div class="col-3">
                                                <input wire:model.lazy="matricola.{{$item->id}}" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Matricola">
                                            </div>
                                            <div class="col-4">
                                                <a wire:click="aggiungiAlDdt({{$item}}, {{$filiale->id}})" class="btn btn-success">aggiungi al DDT</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                        @foreach($ddt as $key => $item)
                            <div class="rounded border p-1 my-2 mr-4" style="background-color: #052e3c; box-shadow: 2px 2px 4px #000000; color: white">
                                <div class="row justify-between my-1 align-items-center">
                                    <div class="col-3">
                                        <p >{{$item['listino']['nome']}}</p>
                                    </div>
                                    <div class="col-7">
                                        <p>{{$item['matricolaAssociata']}}</p>
                                    </div>
                                    <div class="col-2">
                                        <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="removeFromDdt({{$key}})"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if(count($ddt) > 0)   <a wire:click="produciDdt()" class="btn btn-success mt-5">produci DDT</a> @endif










             {{--   @foreach($FilialiprodottiRichiesti as $filiale)
                    <h2 class="mt-3">Filiale: {{$filiale->nome}}</h2>
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                            @foreach($filiale->products as $item)
                                <div class="row justify-between my-1 align-items-center">
                                    <div class="col">
                                        {{$item->fornitore->nome}}
                                    </div>
                                    <div class="col">
                                        {{$item->listino->nome}}
                                    </div>
                                    <div class="col">
                                        {{$item->created_at->format('d/m/Y')}}
                                    </div>
                                    <div class="col-3">
                                        <input wire:model.lazy="matricola.{{$item->id}}" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Matricola">
                                    </div>
                                    <div class="col-4">
                                        <a wire:click="aggiungiAlDdt({{$item}})" class="btn btn-success">aggiungi al DDT</a>
                                    </div>
                                </div>
                            @endforeach

                    </div>
                @endforeach
                <div style="height: 190px; overflow: auto">
                    @foreach($ddt as $key => $item)
                        <div class="rounded border p-1 my-2 mr-4" style="background-color: #052e3c; box-shadow: 2px 2px 4px #000000; color: white">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col-3">
                                    <p >{{$item['listino']['nome']}}</p>
                                </div>
                                <div class="col-7">
                                    <p>{{$item['matricolaAssociata']}}</p>
                                </div>
                                <div class="col-2">
                                    <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="removeFromDdt({{$key}})"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>--}}

            </div>
            <div class="col-5">
                <p class="font-bold text-lg ">Recall Oggi</p>
                @foreach($recallsOggi as $filiale)
                    <h2 class="mt-3">Filiale: {{$filiale->nome}}</h2>
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        @foreach($filiale->clients as $item)
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    {{$item->nome}}
                                </div>
                                <div class="col">
                                    {{$item->cognome}}
                                </div>
                                <div class="col">
                                    {{$item->telefono}}
                                </div>
                                <div class="col">
                                    <a class="btn btn-success">fatta</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <p class="font-bold text-lg mt-5">Recall Domani</p>
                @foreach($recallsDomani as $filiale)
                    <h2 class="mt-3">Filiale: {{$filiale->nome}}</h2>
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        @foreach($filiale->clients as $item)
                            <div class="row justify-between my-1 align-items-start">
                                <div class="col">
                                    {{$item->nome}}
                                </div>
                                <div class="col">
                                    {{$item->cognome}}
                                </div>
                                <div class="col">
                                    {{$item->telefono}}
                                </div>
                                <div class="col">
                                    <a class="btn btn-success">fatta</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<div xmlns:wire="http://www.w3.org/1999/xhtml">
    @if (session()->has('message'))
        <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm mb-2">
            {{ session('message') }}
        </div>
    @endif
<div class="row">
    <div class="col-6">
        <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
            <div class="row justify-between my-1 align-items-center">
                <div class="col-4">
                    <select wire:model="tipoId" class="form-select" aria-label="Default select example">
                        <option>TIPO PAZIENTE</option>
                        @foreach($tipologie as $tipo)
                            @if($tipo->nome != 'DEC')
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input wire:model="giorni" type="number" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="giorni">
                </div>
                <div class="col">
                    <button wire:click="associa()" {{$giorni ? '' : 'disabled'}} class="btn btn-success">ASSOCIA</button>
                </div>

            </div>
        </div>

        <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
            <div class="row justify-between my-1 align-items-start">
                <div class="col-12">
                    <p class="font-bold text-lg ">Tempistiche di recall</p>
                    @foreach($tipologie as $tipo)
                            <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                                <div class="row justify-between my-1 align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="font-bold text-left">{{$tipo->nome}}</p>
                                            </div>
                                            <div class="col-4">
                                                <p class="font-bold text-left">{{$tipo->recall}}</p>
                                            </div>
                                            <div class="col-1">
                                                <i title="elimina" class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$tipo->id}})"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
            <div class="row justify-between my-1 align-items-center">
                <div class="col-4">
                    <input wire:model="nuovoTipo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Tipologia">
                </div>
                <div class="col-3">
                    <input wire:model="nuoviGiorni" type="number" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="giorni">
                </div>
                <div class="col">
                    <button wire:click="crea()" {{$nuovoTipo && $nuoviGiorni ? '' : 'disabled'}} class="btn btn-success">CREA</button>
                </div>

            </div>
        </div>
    </div>

</div>


</div>


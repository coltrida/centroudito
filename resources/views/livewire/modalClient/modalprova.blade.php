<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="background-color: rgb(235,197,84);">
            <div class="modal-header" >
                <h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Prova di: {{$clientName}} {{$clientCognome}}</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 470px;">
                <form wire:submit.prevent="aggiungi">
                    <div class="row">
                        <div class="col">
                            <select wire:model="stato" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>stato</option>
                                    <option selected value="{{config('enum.statoAPA.prova')}}">In Prova</option>
                                    <option value="{{config('enum.statoAPA.fattura')}}">Vendita</option>
                            </select>
                        </div>
                        <div class="col">
                            <select wire:model="fornitoreId" wire:change="scegliFornitore($event.target.value)" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>fornitore</option>
                                @foreach($fornitori as $item)
                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select wire:model="product" wire:click="scegliProdotto($event.target.value)" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option value="">prodotto</option>
                                @foreach($prodottiInMagazzino as $item)
                                    <option value="{{$item}}">{{$item->listino->nome}} - {{$item->matricola}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select wire:model="orecchio" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option value="">orecchio</option>
                                <option value="sx">SX</option>
                                <option value="dx">DX</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model.lazy="importo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2">
                        </div>
                    </div>

                    <a wire:click="aggiungiAllaProva({{$product}})" class="btn btn-success">aggiungi alla prova</a>

                    <div style="height: 190px; overflow: auto">
                        @foreach($prodotti as $key => $item)
                        <div class="rounded border p-1 my-2 mr-4" style="background-color: #052e3c; box-shadow: 2px 2px 4px #000000; color: white">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <p >{{$item['listino']['nome']}}</p>
                                </div>
                                <div class="col">
                                    <p>{{$item['prezzoProposto']}}</p>
                                </div>
                                <div class="col">
                                    <p>{{$item['orecchio']}}</p>
                                </div>
                                <div class="col">
                                    <p>{{$item['matricola']}}</p>
                                </div>
                                <div class="col-1">
                                    <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="removeFromProva({{$key}}, {{$item['id']}}, {{$item['prezzoProposto']}})"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($totale) <h3>Totale prova: € {{$totale}}</h3>  @endif
                    </div>
                    <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
                </form>
                <div style="height: 100px; overflow: auto">
                    @foreach($prove as $item)
                        <div class="rounded border my-2 mr-4" style="background-color: #052e3c; box-shadow: 2px 2px 4px #000000; color: white">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <p style="font-size: 12px; padding-left: 10px">{{$item->inizio_prova}}</p>
                                </div>
                                <div class="col">
                                    <p style="font-size: 12px">{{$item->stato}}</p>
                                </div>
                                <div class="col">
                                    <p style="font-size: 12px">€ {{$item->tot}}</p>
                                </div>
                                <div class="col">
                                    @foreach($item->product as $prodotto)
                                        <div style="font-size: 12px">{{$prodotto->listino->nome}} - {{$prodotto->matricola}}</div>
                                    @endforeach
                                </div>
                                <div class="col-1">
                                    @if($item->stato == config('enum.statoAPA.prova'))
                                        <i title="vendita" class="fas fa-check-square text-green-200 hover:text-green-600 cursor-pointer" wire:click="$emit('clientFattura', {{$item->id}})"></i>
                                    @endif
                                </div>
                                <div class="col-1">
                                    @if($item->stato == config('enum.statoAPA.prova'))
                                    <i title="reso" class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



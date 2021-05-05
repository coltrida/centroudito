<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="background-color: rgb(139,139,139);">
            <div class="modal-header" >
                {{--<h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Prova di: {{$clientName}} {{$clientCognome}}</h5>--}}
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 470px;">
                <form wire:submit.prevent="aggiungi">
                    <div class="row">
                        <div class="col">
                            {{--<select wire:model="stato" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>stato</option>
                                <option value="inProva">In Prova</option>
                                <option value="vendita">Vendita</option>
                            </select>--}}
                        </div>
                        <div class="col">
                            {{--<select wire:model="fornitoreId" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>fornitore</option>
                                @foreach($fornitori as $item)
                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                @endforeach
                            </select>--}}
                        </div>
                        <div class="col">
                            {{--<select wire:model="product" wire:click="scegliProdotto($event.target.value)" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option value="">prodotto</option>
                                @foreach($prodottiInMagazzino as $item)
                                    <option value="{{$item}}">{{$item->listino->nome}} - {{$item->matricola}}</option>
                                @endforeach
                            </select>--}}
                        </div>
                        <div class="col">
                            {{--<select wire:model="orecchio" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option value="">orecchio</option>
                                <option value="sx">SX</option>
                                <option value="dx">DX</option>
                            </select>--}}
                        </div>
                        <div class="col">
                            {{--<input wire:model.lazy="importo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2">--}}
                        </div>
                    </div>

                    <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Fattura</button>
                </form>
            </div>
        </div>
    </div>
</div>




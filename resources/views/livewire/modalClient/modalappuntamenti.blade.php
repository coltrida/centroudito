<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="background-color: rgb(26,65,235);">
            <div class="modal-header" >
                <h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Appuntamenti di: {{$clientName}} {{$clientCognome}}</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 370px;">
                <form wire:submit.prevent="aggiungi">
                    <div class="row">
                        <div class="col">
                            <input wire:model="giorno" class="w-full rounded border shadow p-2 mr-2 my-2" type="date">
                        </div>
                        <div class="col">
                            <input wire:model="ore" class="w-full rounded border shadow p-2 mr-2 my-2" type="time">
                        </div>
                        <div class="col">
                            <select wire:model="filialeId" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>filiale</option>
                                @foreach($filiali as $item)
                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select wire:model="recapitoId" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                                <option selected>recapito</option>
                                @foreach($recapiti as $item)
                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input wire:model="note" class="w-full rounded border shadow p-2 mr-2 my-2" type="text">
                        </div>
                    </div>
                    <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
                </form>
                <div style="height: 230px; overflow: auto">
                    @foreach($appuntamenti as $item)
                        <div class="rounded border p-3 my-2 mr-4" style="background-color: #052e3c; box-shadow: 2px 2px 4px #000000; color: white">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <p >{{$item->giorno}}</p>
                                </div>
                                <div class="col">
                                    <p >{{$item->orario}}</p>
                                </div>
                                @if(isset($item->filiale->nome))
                                <div class="col">
                                    <p >{{$item->filiale->nome}}</p>
                                </div>
                                @endif
                                @if(isset($item->recapito->nome))
                                <div class="col">
                                    <p >{{$item->recapito->nome}}</p>
                                </div>
                                @endif
                                <div class="col-4">
                                    <p >{{$item->nota}}</p>
                                </div>
                                <div class="col-1">
                                    <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


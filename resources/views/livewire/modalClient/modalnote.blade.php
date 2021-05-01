<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="background-color: rgb(235,235,0);">
            <div class="modal-header" >
                <h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Note di: {{$clientName}} {{$clientCognome}}</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

                <div class="modal-body" style="height: 370px;">
                    <form wire:submit.prevent="aggiungi">
                        <input wire:model.lazy="nota" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome">
                        <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
                    </form>
                    <div style="height: 230px; overflow: auto">
                    @foreach($note as $item)
                        <div class="rounded border p-3 my-2 mr-4" style="background-color: #b7b809; box-shadow: 2px 2px 4px #000000;">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <p >{{$item->testo}}</p>
                                </div>
                                <div class="col-3">
                                    <p class="font-bold">{{$item->created_at->format('d/m/Y')}}</p>
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


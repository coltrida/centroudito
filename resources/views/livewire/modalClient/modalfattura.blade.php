<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="background-color: rgb(177,177,177);">
            <div class="modal-header" >
                <h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Lista Fatture</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="height: 470px;">
                @foreach($listaFatture as $provaFattura)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                        <div class="col">
                            {{$provaFattura->fattura->data_fattura}}
                        </div>
                        <div class="col">
                            @foreach($provaFattura->product as $prodotto)
                                <div>{{$prodotto->listino->nome}} - {{$prodotto->matricola}}</div>
                            @endforeach
                        </div>
                        <div class="col">
                            € {{$provaFattura->fattura->tot_fattura}}
                        </div>
                        <div class="col">
                            € {{$provaFattura->fattura->acconto}}
                        </div>
                        <div class="col">
                            {{$provaFattura->fattura->nr_rate}}
                        </div>
                        <div class="col">
                            € {{$provaFattura->fattura->al_saldo}}
                        </div>
                        <div>

                        </div>
                    </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</div>




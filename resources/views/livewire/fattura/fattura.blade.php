<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content" style="color: black">
            <div class="modal-header" >
                {{--<h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Prova di: {{$clientName}} {{$clientCognome}}</h5>--}}
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="fattura">
                    <div class="row">
                        <div class="mb-3 col-3">
                            <div  class="form-label">NOME </div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->nome : ''}} </div>
                        </div>
                        <div class="mb-3 col-3">
                            <div  class="form-label">COGNOME </div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->cognome : ''}} </div>
                        </div>
                        <div class="mb-3 col-3">
                            <div  class="form-label">TELEFONO</div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->telefono : ''}}</div>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="codfisc" class="form-label">Codice Fiscale</label>
                            <input type="text"  wire:model="codfisc" class="form-control" placeholder="codice fiscale">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-5">
                            <div  class="form-label">INDIRIZZO </div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->indirizzo : ''}} </div>
                        </div>
                        <div class="mb-3 col-3">
                            <div  class="form-label">CITTA' </div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->citta : ''}} </div>
                        </div>
                        <div class="mb-3 col-2">
                            <div  class="form-label">CAP </div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->cap : ''}} </div>
                        </div>
                        <div class="mb-3 col-2">
                            <div  class="form-label">PR</div>
                            <div  class="form-label">{{isset($prova) ? $prova->client->provincia : ''}} </div>
                        </div>
                    </div>

                    @if(isset($prova))
                        @foreach($prova->product as $prodotto)
                            <div class="row">
                                <div class="col">{{$prodotto->matricola}}</div>
                                <div class="col">{{$prodotto->listino->nome}}</div>
                                <div class="col">€ {{$prodotto->pivot->prezzo}}</div>
                            </div>
                        @endforeach

                            <div class="row">
                                <div class="col">
                                    <label for="acconto" class="form-label">Acconto</label>
                                    <input type="number"  wire:model="acconto" class="form-control" placeholder="acconto">
                                </div>
                                <div class="col">
                                    <label for="rate" class="form-label">Nr. Rate</label>
                                    <input type="number"  wire:model="rate" class="form-control" placeholder="rate">
                                </div>
                                <div class="col">
                                    <label for="totale" class="form-label">Totale Fattura</label>
                                    <input type="number"  wire:model="totFattura" class="form-control" >
                                </div>
                            </div>
                    @endif
                    <button {{$codfisc ? '' : 'disabled'}} type="submit" class="mt-3 p-2 bg-blue-500 w-20 rounded shadow text-white" style="background-color: {{$codfisc ? 'green' : 'red'}}">Fattura</button>
                </form>
            </div>
        </div>
    </div>
</div>




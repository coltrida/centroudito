<div>
    <div class="modal fade" id="listaProductsInMagazzino" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Presenti in Filiale</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row bg-body-secondary p-2">
                        <div class="col">Matricola</div>
                        <div class="col">Nome</div>
                        <div class="col text-center">Seleziona</div>
                    </div>
                    @foreach($productsInFiliale as $item)
                        <div class="row p2 mt-2">
                            <div class="col">{{$item->matricola}}</div>
                            <div class="col">{{$item->listino->nome}}</div>
                            <div class="col text-center">
                                <input class="form-check-input mt-0 border-dark" type="checkbox"
                                       value="{{$item->id}}" wire:model.defer="prodottiSelezionati"
                                       aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    @endforeach
                    <input type="button" wire:click="aggiungiProddottiAllaProva" data-bs-dismiss="modal" class="btn btn-primary mt-3" value="Aggiungi">
                </div>
            </div>
        </div>
    </div>

    <h3>Prova per {{$cliente->nome.' '.$cliente->cognome}}</h3>
    <div class="row mt-5">
        <div class="col-3">
            <select class="form-select border-dark shadow" aria-label="Default select example"
                    id="marketing_id" name="marketing_id" wire:model.defer="marketing_id">
                <option selected></option>
                @foreach($canali as $item)
                    <option
                        value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <label for="marketing_id" class="ml-2 text-gray-600">Canale Mkt</label>
        </div>

        <div class="col-2">
            <select class="form-select border-dark shadow" aria-label="Default select example"
                    id="mercato" name="mercato" wire:model.defer="mercato">
                <option selected></option>
                <option>libero</option>
                <option>Riconducibile</option>
                <option>Sociale</option>
            </select>
            <label for="mercato" class="ml-2 text-gray-600">Mercato</label>
        </div>

        <div class="col-2">
            <select class="form-select border-dark shadow" aria-label="Default select example"
                    id="filiale_id" name="filiale_id" wire:model.defer="filiale_id">
                <option selected></option>
                @foreach($filiali as $item)
                    <option
                        value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
            <label for="filiale_id" class="ml-2 text-gray-600">Filiale</label>
        </div>

        <div class="col-4">
            <select class="form-select border-dark shadow" aria-label="Default select example"
                    id="recapito_id" name="recapito_id" wire:model.defer="recapito_id">
                <option selected></option>
                @foreach($cliente->user->recapito as $item)
                    <option
                        value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
            <label for="recapito_id" class="ml-2 text-gray-600">Recapito</label>
        </div>

        <div class="mt-3">
            <button type="button"
                    wire:click="$toggle('showDiv')"
                    class="btn btn-primary">
                Crea Prova
            </button>
        </div>
    </div>
    @if ($showDiv)
        <div class="row mt-5">
                <div class="col-4">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="fornitore_id" name="fornitore_id" wire:model.defer="idFornitore"
                            wire:change="$emit('fornitoreSelezionato', $event.target.value)">
                        <option selected></option>
                        @foreach($fornitori as $item)
                            <option
                                value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label for="fornitore_id" class="ml-2 text-gray-600">Fornitori</label>
                </div>
                <div class="col-2">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="categoria_id" name="categoria_id" wire:model.defer="idCategoria"
                            wire:change="$emit('categoriaSelezionata', $event.target.value)">
                        <option selected></option>
                        @foreach($categorie as $item)
                            <option
                                value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label for="categoria_id" class="ml-2 text-gray-600">Categoria</label>
                </div>
                <div class="col-4">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="listino_id" name="listino_id" wire:change="$emit('caricaProdottiMagazzino', $event.target.value)">
                        <option selected></option>
                        @foreach($prodotti as $item)
                            <option
                                value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label for="listino_id" class="ml-2 text-gray-600">Prodotto</label>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listaProductsInMagazzino">
                        <i class="fas fa-fw fa-plus"></i>
                    </button>
                </div>
        </div>
    @endif

    @if ($showEleInProva)
        <div class="row mt-5">
            <h3>Prodotti in Prova ({{count($eleInProva)}})</h3>
            <table class="table table-striped" id="prodottiInProva">
                <thead class="table-primary">
                <th scope="col" style="width: 20%">Matricola</th>
                <th scope="col" style="width: 40%">Prodotto</th>
                <th scope="col" style="width: 20%">Prezzo</th>
                <th scope="col" style="width: 20%; text-align: center">Action</th>
                </thead>
                <tbody>
                @foreach($eleInProva as $item)
                    <tr>
                        <td>{{$item->matricola}}</td>
                        <td>{{$item->listino->nome}}</td>
                        <td>
                            <input type="text" class="form-control border-dark shadow prezzi"
                                   wire:keyup="aggiornaSomma"
                                  wire:model="prezzi.{{ $loop->index }}">
                        </td>
                        <td style="text-align: center">
                            <button type="submit" style="border: none; padding: 0"
                                    wire:click="eliminaProdottoDallaProva({{$item->id}})"
                                    title="elimina prodotto">
                                <i class="fas fa-fw fa-trash" style="color: red"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>TOT</td>
                    <td>&nbsp;</td>
                    <td>
                        <span>{{$tot}}</span>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <button type="button"
                                wire:click="salvaProva"
                                class="btn btn-primary">
                            Salva Prova
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>

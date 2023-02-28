<div>
    <div class="modal fade" id="modale" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">titolo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3">
            <h3>Magazzino {{$filiale->nome}}</h3>
        </div>
        <div class="col-2">
            <h4>Richiedi Prodotto</h4>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-3">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="fornitore_id"
                            wire:change="fornitoreSelezionato($event.target.value)">
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
                            id="categoria_id"
                            wire:change="categoriaSelezionata($event.target.value)">
                        <option selected></option>
                        @foreach($categorie as $item)
                            <option
                                value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label for="categoria_id" class="ml-2 text-gray-600">Categoria</label>
                </div>
                <div class="col-3">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="listino_id" name="listino_id" wire:change="prodottoSelezionato($event.target.value)">
                        <option selected></option>
                        @foreach($prodotti as $item)
                            <option
                                value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                    <label for="listino_id" class="ml-2 text-gray-600">Prodotto</label>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control border-dark shadow" wire:model="quantita">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary" wire:click="richiestaProdotti">
                        Richiedi
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div class="d-sm-flex align-items-center justify-content-between ">
        <div>
            <h3>&nbsp;</h3>
        </div>
        <div>
            <h3>Prodotti Presenti</h3>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped" id="prodottiInProva">
            <thead class="table-dark">
            <th scope="col" style="width: 20%">Matricola</th>
            <th scope="col" style="width: 30%">Prodotto</th>
            <th scope="col" style="width: 30%">Fornitore</th>
            <th scope="col" style="width: 20%">Prezzo</th>
            </thead>
            <tbody>
            @foreach($prodottiPresenti as $item)
                <tr>
                    <td>{{$item->matricola}}</td>
                    <td>{{$item->listino->nome}}</td>
                    <td>{{$item->listino->fornitore->nome}}</td>
                    <td>{{$item->listino->prezzolistino}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mt-3">
        <div>
            <h3>&nbsp;</h3>
        </div>
        <div>
                <h3>Prodotti Richiesti</h3>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped" id="prodottiInProva">
            <thead class="table-dark">
            <th scope="col" style="width: 20%">Data Richiesta</th>
            <th scope="col" style="width: 30%">Prodotto</th>
            <th scope="col" style="width: 30%">Fornitore</th>
            <th scope="col" style="width: 20%">Quantità</th>
            </thead>
            <tbody>
            @foreach($this->prodottirichiesti as $item)
                <tr>
                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                    <td>{{$item->listino->nome}}</td>
                    <td>{{$item->listino->fornitore->nome}}</td>
                    <td>{{$item->quantita}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mt-3">
        <div>
            <h3>&nbsp;</h3>
        </div>
        <div>
                <h3>Prodotti In Arrivo</h3>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped" id="prodottiInProva">
            <thead class="table-dark">
            <th scope="col" style="width: 20%">Matricola</th>
            <th scope="col" style="width: 30%">Prodotto</th>
            <th scope="col" style="width: 30%">Fornitore</th>
            <th scope="col" style="width: 20%">Prezzo</th>
            </thead>
            <tbody>
            @foreach($prodottiInArrivo as $item)
                <tr>
                    <td>{{$item->matricola}}</td>
                    <td>{{$item->listino->nome}}</td>
                    <td>{{$item->listino->fornitore->nome}}</td>
                    <td>{{$item->listino->prezzolistino}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


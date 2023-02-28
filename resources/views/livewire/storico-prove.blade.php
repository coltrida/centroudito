<div>
    <!-- Modal -->
    <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Prodotti Prova</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row bg-body-secondary p-2">
                        <div class="col">Matricola</div>
                        <div class="col">Nome</div>
                        <div class="col">Prezzo</div>
                    </div>
                    @foreach($prodottiProva as $item)
                        <div class="row p2 mt-2">
                            <div class="col">{{$item->matricola}}</div>
                            <div class="col">{{$item->listino->nome}}</div>
                            <div class="col">{{$item->pivot?->prezzo}}</div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="fatturaModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Prodotti Prova</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="acconto" wire:model.defer="acconto" placeholder="name@example.com">
                        <label for="acconto" class="ml-2 text-gray-600">Acconto</label>
                    </div>

                    <div class="form-floating mt-3">
                        <input type="number" class="form-control" id="rate" wire:model.defer="rate" placeholder="name@example.com">
                        <label for="rate" class="ml-2 text-gray-600">Rate</label>
                    </div>

                    <div class="form-floating mt-3">
                        <span>Tot Fattura {{$totFatturaReale}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="fattura">Salva Fattura</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped" id="prodottiInProva">
        <thead class="table-primary">
        <th scope="col">Data Prova</th>
        <th scope="col">Stato</th>
        <th scope="col">Mercato</th>
        <th scope="col">Tot</th>
        <th scope="col" style="text-align: center">Action</th>
        </thead>
        <tbody>
        @foreach($storicoProve as $item)
            <tr>
                <td>{{$item->inizio_prova}}</td>
                <td>
                    @if($item->stato->nome === 'FATTURA')
                    <span class="badge text-bg-success">
                        {{$item->stato->nome}}
                    </span>
                        @elseif($item->stato->nome === 'RESO')
                            <span class="badge text-bg-danger">
                                {{$item->stato->nome}}
                            </span>
                        @else
                            <span class="badge text-bg-primary">
                                {{$item->stato->nome}}
                            </span>
                    @endif
                </td>
                <td>{{$item->mercato}}</td>
                <td>{{$item->tot}}</td>
                <td style="text-align: center">
                    <button type="button"
                            wire:click="visualizzaProdotti({{$item}})"
                            style="border: none; padding: 0"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            title="Prodotti">
                        <i class="fas fa-fw fa-eye" style="color: #0d6efd"></i>
                    </button>
                    @if($item->stato->nome === 'FATTURA')
                        <a  target="_blank" href="{{asset('/storage/fatture/2023/'.$item->fattura->id.'.pdf')}}"
                                title="fattura">
                            <i class="fas fa-fw fa-money-bill" style="color: green"></i>
                        </a>
                    @endif
                    @if($item->stato->nome !== 'FATTURA' && $item->stato->nome !== 'RESO')
                        <button type="button"
                                wire:click="reso({{$item}})"
                                style="border: none; padding: 0"
                                title="Reso">
                            <i class="fas fa-fw fa-thumbs-down" style="color: red"></i>
                        </button>

                        <button type="button"
                                wire:click="provaSelezionataPerFattura({{$item}})"
                                style="border: none; padding: 0"
                                data-bs-toggle="modal"
                                data-bs-target="#fatturaModal"
                                title="Fattura">
                            <i class="fas fa-fw fa-thumbs-up" style="color: green"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

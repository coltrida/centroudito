<div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
                            <div class="col">{{$item->pivot->prezzo}}</div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <td>{{$item->stato->nome}}</td>
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

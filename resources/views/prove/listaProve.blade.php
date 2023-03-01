@extends('layouts.style')

@section('content')
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

    <div class="d-sm-flex align-items-center justify-content-between ">
        <div>
            <h3>Prove della Filiale: {{$filiale->nome}}</h3>
        </div>
    </div>


        <table class="table table-striped" id="prodottiInProva">
            <thead class="table-dark">
            <th scope="col">Inizio Prova</th>
            <th scope="col">Paziente</th>
            <th scope="col">totale</th>
            <th scope="col">Prodotti</th>
            </thead>
            <tbody>
            @foreach($prove as $item)
                <tr>
                    <td>{{$item->inizio_prova}}</td>
                    <td>{{$item->client->nome.' '.$item->client->cognome}}</td>
                    <td>{{$item->tot}}</td>
                    <td>
                        @foreach($item->product as $prodotto)
                            <div>{{$prodotto->listino->nome}}</div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

</div>
@endsection

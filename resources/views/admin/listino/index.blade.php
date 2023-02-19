@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Listino</h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('admin.listino.aggiungi')}}">Aggiungi</a>
        </div>

    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <th scope="col">Nome</th>
            <th scope="col">Fornitore</th>
            <th scope="col">Categoria</th>
            <th scope="col">Costo</th>
            <th scope="col">Prezzo lis</th>
            <th scope="col">Sconto max</th>
            <th scope="col">Iva</th>
            <th scope="col">gg di reso</th>
            <th scope="col">Actions</th>
        </thead>
        <tbody class="table-group-divider">
            @foreach($listino as $item)
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->fornitore->nome}}</td>
                    <td>{{$item->categoria->nome}}</td>
                    <td>{{$item->costo}}</td>
                    <td>{{$item->prezzolistino}}</td>
                    <td>{{$item->scontoMax}}</td>
                    <td>{{$item->iva}}</td>
                    <td>{{$item->giorniTempoDiReso}}</td>
                    <td>
                        <a class="btn btn-danger" href="{{route('admin.listino.elimina', $item->id)}}" title="elimina">
                            <i class="fas fa-fw fa-trash"></i>
                        </a>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" title="soglie">
                            <i class="fas fa-fw fa-eye"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Soglie Minime</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach($item->filiale as $filiale)
                                            {{$filiale->nome}} : {{$filiale->pivot->soglia}} <br>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection


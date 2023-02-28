@extends('layouts.style')

@section('content')
    <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confermaElimina"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma Eliminazione <span id="nomeClienteElimina"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il paziente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('client.elimina')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="idClientElimina" id="idClientElimina">

                        @if(isset($clients[0]))
                            <input type="hidden" name="filiale_id" value="{{$clients[0]->filiale->id}}">
                        @endif
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                Clienti {{$filiale->nome}}
            </h1>
        </div>
        <div>
            <form class="d-flex" role="search" method="post" action="{{route('client.ricerca')}}" id="ricercaForm">
                @csrf
                <input type="hidden" name="idFiliale" value="{{$filiale->id}}">
                <input class="form-control me-2 border-dark shadow" type="search" name="testo" id="testoRicerca" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button> &nbsp;
                <button class="btn btn-outline-warning" type="reset" id="resetBtn">Reset</button>
            </form>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('client.aggiungiModifica', $filiale->id)}}">Aggiungi</a>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Actions</th>
                <th scope="col">Cod</th>
                <th scope="col">Cognome</th>
                <th scope="col">Nome</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Città</th>
                <th scope="col">CAP</th>
                <th scope="col">PR</th>
                <th scope="col">tel1</th>
                <th scope="col">tel2</th>
                <th scope="col">tel3</th>
                <th scope="col">Recapito</th>
                <th scope="col">Data Nascita</th>
                <th scope="col">email</th>
                <th scope="col">Fonte</th>
                <th scope="col">Audio</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($clients as $item)
                    <tr>
                        <td>
                            <a style="text-decoration: none" href="#" data-bs-toggle="modal" data-bs-target="#confermaElimina" title="elimina">
                                <i id="{{$item}}" class="fas fa-fw fa-trash" style="color: red"></i>
                            </a>
                            <a style="text-decoration: none" href="{{route('client.aggiungiModifica', ['idFiliale' => $clients[0]->filiale->id, 'idClient' => $item->id])}}" title="modifica">
                                <i class="fas fa-fw fa-pencil"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Audiogramma">
                                <i class="fas fa-fw fa-headphones" style="color: green"></i>
                            </a>
                            <a style="text-decoration: none" href="{{route('appuntamenti', $item->id)}}" title="Appuntamento">
                                <i class="fas fa-fw fa-calendar" style="color: purple"></i>
                            </a>
                            <a style="text-decoration: none" href="{{route('prova', $item->id)}}" title="Prova">
                                <i class="fa fa-assistive-listening-systems" style="color: orange"></i>
                            </a>
                            <a style="text-decoration: none" href="{{route('documenti', $item->id)}}" title="Documenti">
                                <i class="fas fa-fw fa-file" style="color: darkblue"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Recall">
                                <i class="fas fa-fw fa-phone" style="color: darkgreen"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Storico">
                                <i class="fas fa-fw fa-info-circle" style="color: black"></i>
                            </a> &nbsp;&nbsp;
                        </td>
                        <td>{{$item->tipologia->nome}}</td>
                        <td>{{$item->cognome}}</td>
                        <td>{{$item->nome}}</td>
                        <td>{{$item->indirizzo}}</td>
                        <td>{{$item->citta}}</td>
                        <td>{{$item->cap}}</td>
                        <td>{{$item->provincia}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->telefono2}}</td>
                        <td>{{$item->telefono3}}</td>
                        <td>{{$item->recapito->nome}}</td>
                        <td>{{$item->datanascita}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->marketing->name}}</td>
                        <td>{{$item->user->name}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="16">
                        {{$clients->links()}}
                    </td>
                </tr>
                </tbody>
            </table>
    </div>

@endsection

@extends('partial.gestioneModal')
@extends('partial.resetRicerca')

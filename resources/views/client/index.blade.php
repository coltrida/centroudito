@extends('layouts.style')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                Clienti
                @if(isset($clients[0]))
                    - {{$clients[0]->filiale->nome}}
                @endif
            </h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('client.aggiungi', $clients[0]->filiale->id)}}">Aggiungi</a>
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
                <th scope="col">Data Nascita</th>
                <th scope="col">email</th>
                <th scope="col">Fonte</th>
                <th scope="col">Audio</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($clients as $item)
                    <tr>
                        <td>
                            <a style="text-decoration: none" href="{{route('client.elimina', $item->id)}}" title="elimina">
                                <i class="fas fa-fw fa-trash" style="color: red"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="modifica">
                                <i class="fas fa-fw fa-pencil"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Audiogramma">
                                <i class="fas fa-fw fa-headphones" style="color: green"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Appuntamento">
                                <i class="fas fa-fw fa-calendar" style="color: purple"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Prova">
                                <i class="fa fa-assistive-listening-systems" style="color: orange"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Documenti">
                                <i class="fas fa-fw fa-file" style="color: darkblue"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Recall">
                                <i class="fas fa-fw fa-phone" style="color: darkgreen"></i>
                            </a>
                            <a style="text-decoration: none" href="#" title="Informazioni">
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
                        <td>{{$item->datanascita}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->marketing->name}}</td>
                        <td>{{$item->user->name}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="15">
                        {{$clients->links()}}
                    </td>
                </tr>
                </tbody>
            </table>
    </div>

@endsection


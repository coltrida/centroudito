@extends('layouts.style')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="confermaElimina" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma Eliminazione <span
                            id="nomeClienteElimina"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare l'appuntamento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('client.elimina')}}" method="post">
                        @csrf
                        @method('DELETE')
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
                Appuntamento per {{$cliente->nome.' '.$cliente->cognome}}
            </h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{ URL::previous() }}">Annulla</a>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <form action="{{route('appuntamento.aggiungi')}}" method="post">
                @csrf
                <input type="hidden" name="client_id" value="{{$cliente->id}}">
                <input type="hidden" name="user_id" value="{{$cliente->user->id}}">
                <div class="row mt-5">
                    <div class="col-4">
                        <input type="date" class="form-control border-dark shadow" id="giorno" name="giorno">
                        <label for="giorno" class="text-gray-600">Data Appuntamento</label>
                    </div>

                    <div class="col-4">
                        <input type="time" min="09:00" max="19:00" step="900"  class="form-control border-dark shadow" id="orario" name="orario">
                        <label for="orario" class="text-gray-600">Orario</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="tipologia_id" name="tipologia_id">
                            <option selected></option>
                            @foreach($audio as $item)
                                <option
                                    value="{{$item->id}}" {{$item->id == Auth::id() ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label for="tipologia_id" class="ml-2 text-gray-600">Audio</label>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="filiale_id" name="filiale_id">
                            <option selected></option>
                            @foreach($filiali as $item)
                                <option
                                    value="{{$item->id}}" {{$item->id == $cliente->filiale_id ? 'selected' : ''}}>{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="filiale_id" class="ml-2 text-gray-600">Filiale</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="recapito_id" name="recapito_id">
                            <option selected></option>
                            @foreach($recapiti as $item)
                                <option value="{{$item->id}}">{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="recapito_id" class="ml-2 text-gray-600">Recapito</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="tipo" name="tipo">
                            <option selected></option>
                                <option>Prima Visita</option>
                                <option>Assistenza</option>
                                <option>Consegna</option>
                                <option>Controllo Prova</option>
                                <option>Esame Audio</option>
                                <option>Fine Prova</option>
                                <option>Informazioni</option>
                                <option>Pulizia</option>
                        </select>
                        <label for="tipo" class="ml-2 text-gray-600">Tipo di Visita</label>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-8">
                        <textarea class="form-control border-dark shadow" id="note" rows="3"></textarea>
                        <label for="note" class="form-label">Note</label>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Inserisci</button>
                    </div>
                </div>

            </form>

            <h3>Storico Appuntamenti</h3>
            <table class="table table-striped">
                <thead class="table-primary">
                <th scope="col">Giorno</th>
                <th scope="col">Orario</th>
                <th scope="col">Nota</th>
                <th scope="col">Luogo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Action</th>
                </thead>
                <tbody >
                @foreach($appuntamenti as $item)
                    <tr>
                        <td>{{$item->giorno}}</td>
                        <td>{{$item->orario}}</td>
                        <td>{{$item->nota}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->provincia}}</td>
                        <td>
                            <form action="{{route('appuntamento.elimina')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="idAppuntamento">
                                <button type="submit" title="elimina" class="btn btn-danger">
                                    <i class="fas fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-6">
            <h3>Calendar</h3>
            <div class="row mb-5">
                <div class="col-4">
                    <select class="form-select border-dark shadow" aria-label="Default select example"
                            id="tipologia_id" name="tipologia_id">
                        <option selected></option>
                        @foreach($audio as $item)
                            <option
                                value="{{$item->id}}" {{$item->id == Auth::id() ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    <label for="tipologia_id" class="ml-2 text-gray-600">Audio</label>
                </div>
            </div>

            @for($i=0; $i<6; $i++)
                <h4 style="margin-top: 30px">{{$nomeGiorno[$i]}} {{$dateSettimana[$i]}}</h4>
                <table class="table table-striped table-sm">
                    <div class="row p-2" style="background: #8f9dee">
                        <div class="col-2">Orario</div>
                        <div class="col-3">Nome</div>
                        <div class="col">Luogo</div>
                        <div class="col">Tipo</div>
                        <div class="col">Note</div>
                    </div>
                    <tbody >
                    @foreach($appSettimana[$i] as $item)
                        <div class="row p-2" style="border-bottom: 1px solid gray">
                            <div class="col-2">{{$item->orario}}</div>
                            <div class="col-3">{{$item->client->nome. ' '.$item->client->cognome}}</div>
                            <div class="col">{{$item->filiale_id ? $item->filiale->nome : $item->recapito->nome}}</div>
                            <div class="col">{{$item->tipo}}</div>
                            <div class="col">{{$item->note}}</div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            @endfor

        </div>
    </div>

@endsection

@extends('partial.gestioneModal')

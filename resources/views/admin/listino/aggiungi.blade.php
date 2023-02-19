@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Listino</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('admin.listino')}}">Annulla</a>
        </div>
    </div>

    <form action="{{route('admin.listino.salva')}}" method="post">
    @csrf

        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="form-floating col-5">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="name@example.com">
                        <label for="nome" class="ml-2 text-gray-600">Nome</label>
                    </div>

                    <div class="form-floating col-4">
                        <select class="form-select" aria-label="Floating label select example" name="fornitore_id" id="fornitore_id">
                            <option selected></option>
                            @foreach($fornitori as $item)
                                <option value={{$item->id}}>{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="fornitore_id" class="ml-2 text-gray-600">Fornitore</label>
                    </div>

                    <div class="form-floating col-3">
                        <select class="form-select" aria-label="Floating label select example" name="categoria_id" id="categoria_id">
                            <option selected></option>
                            @foreach($categorie as $item)
                                <option value={{$item->id}}>{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="categoria_id" class="ml-2 text-gray-600">Categoria</label>
                    </div>


                </div>

                <div class="row mt-5">
                    <div class="form-floating col-3">
                        <input type="number" class="form-control" id="costo" name="costo" placeholder="name@example.com">
                        <label for="costo" class="ml-2 text-gray-600">Costo</label>
                    </div>

                    <div class="form-floating col-3">
                        <input type="number" class="form-control" id="prezzolistino" name="prezzolistino" placeholder="name@example.com">
                        <label for="prezzolistino" class="ml-2 text-gray-600">prezzo lis</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="scontoMax" name="scontoMax" placeholder="name@example.com">
                        <label for="scontoMax" class="ml-2 text-gray-600">scontoMax</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="iva" name="iva" placeholder="name@example.com">
                        <label for="iva" class="ml-2 text-gray-600">iva</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="giorniTempoDiReso" name="giorniTempoDiReso" placeholder="name@example.com">
                        <label for="giorniTempoDiReso" class="ml-2 text-gray-600">giorni Reso</label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h3>Soglie</h3>
                @for($i=0; $i < count($filiali); $i++)
                    <div class="form-floating">
                        <div class="row mb-1">
                            <div class="col">
                                <input type="text" class="form-control" id='soglie[{{$i}}]' name='soglie[{{$i}}]'>
                                <input type="hidden" name='idFiliali[{{$i}}]' value='{{$filiali[$i]->id}}'>
                            </div>
                            <div class="col">
                                <label for='soglie[{{$i}}]' class="ml-2 text-gray-600">{{$filiali[$i]->nome}}</label>
                            </div>
                        </div>

                    </div>
                @endfor
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Inserisci</button>

    </form>

@endsection


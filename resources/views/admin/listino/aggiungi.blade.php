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
                        <input type="text" class="form-control" id="nome" name="nome">
                        <label for="nome">Nome</label>
                    </div>

                    <div class="form-floating col-4">
                        <select class="form-control" aria-label="Default select example" name="fornitore_id" id="fornitore_id">
                            <option selected></option>
                            @foreach($fornitori as $item)
                                <option value={{$item->id}}>{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="fornitore_id">Fornitore</label>
                    </div>

                    <div class="form-floating col-3">
                        <select class="form-control" aria-label="Default select example" name="categoria_id" id="categoria_id">
                            <option selected></option>
                            @foreach($categorie as $item)
                                <option value={{$item->id}}>{{$item->nome}}</option>
                            @endforeach
                        </select>
                        <label for="categoria_id">Categoria</label>
                    </div>


                </div>

                <div class="row mt-5">
                    <div class="form-floating col-3">
                        <input type="number" class="form-control" id="costo" name="costo">
                        <label for="costo">Costo</label>
                    </div>

                    <div class="form-floating col-3">
                        <input type="number" class="form-control" id="prezzolistino" name="prezzolistino">
                        <label for="prezzolistino">prezzo lis</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="scontoMax" name="scontoMax">
                        <label for="scontoMax">scontoMax</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="iva" name="iva">
                        <label for="iva">iva</label>
                    </div>

                    <div class="form-floating col-2">
                        <input type="number" class="form-control" id="giorniTempoDiReso" name="giorniTempoDiReso">
                        <label for="giorniTempoDiReso">giorniTempoDiReso</label>
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
                                <label for='soglie[{{$i}}]'>{{$filiali[$i]->nome}}</label>
                            </div>
                        </div>

                    </div>
                @endfor
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Inserisci</button>

    </form>

@endsection


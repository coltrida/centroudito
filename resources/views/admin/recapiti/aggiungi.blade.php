@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Recapito</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('admin.recapiti')}}">Annulla</a>
        </div>
    </div>

    <form action="{{route('admin.recapiti.salva')}}" method="post">
    @csrf

    <div class="row">
        <div class="form-floating col-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="name@example.com">
            <label for="nome" class="ml-2 text-gray-600">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="name@example.com">
            <label for="indirizzo" class="ml-2 text-gray-600">Indirizzo</label>
        </div>

        <div class="form-floating col-4">
            <input type="text" class="form-control" id="citta" name="citta" placeholder="name@example.com">
            <label for="citta" class="ml-2 text-gray-600">Città</label>
        </div>
    </div>

    <div class="row mt-5">
        <div class="form-floating col-3">
            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="name@example.com">
            <label for="telefono" class="ml-2 text-gray-600">Telefono</label>
        </div>

        <div class="form-floating col-2">
            <input type="number" class="form-control" id="cap" name="cap" placeholder="name@example.com">
            <label for="cap" class="ml-2 text-gray-600">CAP</label>
        </div>

        <div class="form-floating col-2">
            <input type="text" class="form-control" id="provincia" name="provincia" placeholder="name@example.com">
            <label for="provincia" class="ml-2 text-gray-600">Provincia</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="informazioni" name="informazioni" placeholder="name@example.com">
            <label for="informazioni" class="ml-2 text-gray-600">Info</label>
        </div>
    </div>

        <div class="row mt-5">
            <div class="form-floating col-6">
                <select class="form-select" aria-label="Floating label select example" name="user_id" id="user_id">
                    <option selected></option>
                    @foreach($audios as $item)
                        <option value={{$item->id}}>{{$item->name}}</option>
                    @endforeach
                </select>
                <label for="user_id" class="ml-2 text-gray-600">Audioprotesista</label>
            </div>

            <div class="form-floating col-6" id="filiali" style="display: none">
                <select class="form-select" aria-label="Floating label select example" name="filiale_id" id="filiale_id">
                    <option selected></option>

                </select>
                <label for="filiale_id" class="ml-2 text-gray-600">Filiale</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection

@section('footer')
    @parent
    <script>
        $('document').ready(function () {

            $('#user_id').change(function (evt) {
                $("#filiale_id").empty();
                let user_id = this.value;
                let url = window.location.origin + '/admin/filiali/audio/' + user_id;
                $.ajax(url,
                    {
                        method: 'GET',
                        complete: function (resp) {
                            let filiali = resp.responseJSON;
                            if (filiali.length > 1) {
                                filiali.forEach(function(filiale) {
                                    let o = new Option(filiale.nome, filiale.id);
                                    $("#filiale_id").append(o);
                                });
                                $('#filiali').attr("disabled", false);
                                $('#filiali').css('display', 'block')
                            } else {
                                let filialeId = filiali[0].id;
                                let filialeNome = filiali[0].nome;
                                //console.log(filialeId);
                                let o = new Option(filialeNome, filialeId);
                                $("#filiale_id").append(o);
                                $('#filiali').attr("disabled", true);
                            }
                        }
                    }
                )
            });
        });
    </script>
@stop

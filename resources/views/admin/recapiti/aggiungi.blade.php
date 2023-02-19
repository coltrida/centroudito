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
            <input type="text" class="form-control" id="nome" name="nome">
            <label for="nome">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="indirizzo" name="indirizzo">
            <label for="indirizzo">Indirizzo</label>
        </div>

        <div class="form-floating col-4">
            <input type="text" class="form-control" id="citta" name="citta">
            <label for="citta">Città</label>
        </div>
    </div>

    <div class="row mt-5">
        <div class="form-floating col-3">
            <input type="number" class="form-control" id="telefono" name="telefono">
            <label for="telefono">Telefono</label>
        </div>

        <div class="form-floating col-2">
            <input type="number" class="form-control" id="cap" name="cap">
            <label for="cap">CAP</label>
        </div>

        <div class="form-floating col-2">
            <input type="text" class="form-control" id="provincia" name="provincia">
            <label for="provincia">Provincia</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="informazioni" name="informazioni">
            <label for="informazioni">Info</label>
        </div>
    </div>

        <div class="row mt-5">
            <div class="form-floating col-6">
                <select class="form-control" aria-label="Default select example" name="user_id" id="user_id">
                    <option selected></option>
                    @foreach($audios as $item)
                        <option value={{$item->id}}>{{$item->name}}</option>
                    @endforeach
                </select>
                <label for="user_id">Audioprotesista</label>
            </div>

            <div class="form-floating col-6" id="filiali" style="display: none">
                <select class="form-control" aria-label="Default select example" name="filiale_id" id="filiale_id">
                    <option selected></option>

                </select>
                <label for="filiale_id">Filiale</label>
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

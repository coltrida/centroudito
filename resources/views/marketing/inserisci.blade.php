@extends('stile')

@section('main')
    @if(session()->has('message'))
        <div class="alert-warning">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="alert-warning">Mess: {{session()->get('message')}}</div>

    <form action="{{route('client.postInserisci')}}" method="post">
        @csrf
        <div class="row">
            <div class="mb-3 col-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="nome">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection

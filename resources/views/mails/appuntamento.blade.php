@component('mail::message')
    <img src="{{asset('img/logo-centroudito.png')}}" style="width:30%" alt="App Logo">

# Prenotazione Appuntamento

Gentile {{$client->nome}} {{$client->cognome}}, <br><br>
le ricordiamo che ha un appuntamento per <br>
il giorno: <b>{{\Carbon\Carbon::make($appuntamento->giorno)->format('d-m-Y')}}</b> <br>
alle ore: <b>{{$appuntamento->orario}}</b> <br>
tipo di visita: <b>{{$appuntamento->tipo}}</b>
{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Un cordiale saluto,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')

Gentile <b>{{$client['nome']}} {{$client['cognome']}},</b><br>

{{$testoMessaggio}}

Un cordiale saluto,<br><br>

{{ config('app.name') }}
@endcomponent

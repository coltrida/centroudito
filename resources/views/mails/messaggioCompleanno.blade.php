@component('mail::message')
Gentile <b>{{$compleanno['nome']}} {{$compleanno['cognome']}},</b><br>

Centro Udito le augura i nostri migliori auguri e con l'occasione la invita presso il nostro centro acustico
più vicino per un controllo, pulizia e assistenza gratuita e, nel caso ne avesse la necessità, la invita a ritirare
gratuitamente una confezione di pile.

Un cordiale saluto,<br><br>

{{ config('app.name') }}
@endcomponent

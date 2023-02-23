@component('mail::message')
Gentile {{$client->nome}} {{$client->cognome}},<br>

Le ricordiamo il suo appuntamento di domani <b>{{\Carbon\Carbon::make($client->appuntamenti[0]->giorno)->format('d-m-Y')}}</b> <br>
Alle ore: <b>{{\Illuminate\Support\Str::substr($client->appuntamenti[0]->orario, 0, 5)}}</b> <br>
Presso: {{$client->appuntamenti[0]->filiale_id ? 'Filiale di '.$client->appuntamenti[0]->filiale->nome.' - '.$client->appuntamenti[0]->filiale->indirizzo : $client->appuntamenti[0]->recapito->nome.' - '.$client->appuntamenti[0]->recapito->indirizzo}}

Cordialmente,<br>
{{ config('app.name') }}
@endcomponent

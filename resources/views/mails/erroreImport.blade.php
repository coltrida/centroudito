@component('mail::message')
Errore nell'import da Noah:

{{$messaggio}}
<br><br>
Utente: {{$user}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

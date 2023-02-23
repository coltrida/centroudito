@component('mail::message')

Problema nella root principale di CentroUdito! <br><br>
@foreach($valori as $key => $item)
    {{$key}} => {{$item}} <br>
@endforeach
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

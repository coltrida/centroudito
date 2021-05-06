<div class="flex space-x-1 justify-around p-0 m-0 mb-1" style="border-bottom: none" xmlns:wire="http://www.w3.org/1999/xhtml">

    <a href="{{route('client.inserisci', $id)}}" class="btn btn-sm btn-primary"
       style="box-shadow: 2px 2px 4px #000000; width: 35px"
       title="modifica">
        <i class="fas fa-edit"></i>
    </a>

    <a  class="btn btn-sm btn-success mr-1"
       wire:click="$emit('clientSelectedRecall', {{$id}})"
       title="ricontatta"
       style="box-shadow: 2px 2px 4px #000000; width: 35px">
        <i class="fas fa-phone"></i>
    </a>

    <a href="#" class="btn btn-sm btn-warning mr-1"
        wire:click="$emit('clientSelectedNote', {{$id}})"
        title="note" style="box-shadow: 2px 2px 4px #000000; width: 35px">
        <i class="far fa-sticky-note"></i>
    </a>
    <a href="#" class="btn btn-sm mr-1" style="background-color: #c2a449; box-shadow: 2px 2px 4px #000000; width: 35px"
        wire:click="$emit('clientSelectedProva', {{$id}})"
        title="prove">
        <i class="fas fa-assistive-listening-systems"></i>
    </a>
    <a href="#" class="btn btn-sm" style="background-color: #9153c2; box-shadow: 2px 2px 4px #000000; width: 35px" title="audiometrie">
        <i class="fas fa-chart-bar"></i>
    </a>
</div>

<div class="flex space-x-1 justify-around p-0 m-0" style="border-bottom: none" xmlns:wire="http://www.w3.org/1999/xhtml">

    <a href="{{route('client.inserisci', $id)}}" class="btn btn-sm btn-danger"
       style="box-shadow: 2px 2px 4px #000000; width: 35px"
       title="elimina">
        <i class="fas fa-trash"></i>
    </a>

    <a  class="btn btn-sm btn-primary mr-1"
        wire:click="$emit('clientSelectedAppuntamenti', {{$id}})"
        title="appuntamento"
        style="box-shadow: 2px 2px 4px #000000; width: 35px; background-color: #292891; border-color: #060091">
        <i class="far fa-calendar-alt"></i>
    </a>

    <a href="#" class="btn btn-sm btn-warning mr-1"
       wire:click="$emit('listaFatture', {{$id}})"
       title="fatture" style="color: white; background-color: #616161; border-color: #8b8b8b; box-shadow: 2px 2px 4px #000000; width: 35px">
        <i class="fas fa-file-alt"></i>
    </a>
    <a href="#" class="btn btn-sm mr-1" style="color: white;background-color: #c22286; box-shadow: 2px 2px 4px #000000; width: 35px" title="ddt">
        <i class="fas fa-truck"></i>
    </a>
    <a href="#" class="btn btn-sm" style="background-color: #33c269; box-shadow: 2px 2px 4px #000000; width: 35px" title="asl">
        <i class="fas fa-book-medical"></i>
    </a>
</div>

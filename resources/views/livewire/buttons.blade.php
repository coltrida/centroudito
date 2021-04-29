<div class="flex space-x-1 justify-around">

    <a href="{{route('client.inserisci', $id)}}" class="btn btn-sm btn-primary mr-1"
       style="box-shadow: 2px 2px 4px #000000;"
       title="modifica">
        <i class="fas fa-edit"></i>
    </a>

    <a  class="btn btn-sm btn-success mr-1"
       wire:click="$emit('clientSelectedRecall', {{$id}})"
       title="ricontatta"
       style="box-shadow: 2px 2px 4px #000000;">
        <i class="fas fa-phone"></i>
    </a>

    <a href="#" class="btn btn-sm btn-warning mr-1" title="note" style="box-shadow: 2px 2px 4px #000000;">
        <i class="far fa-sticky-note"></i>
    </a>
    <a href="#" class="btn btn-sm mr-1" style="background-color: #c2a449; box-shadow: 2px 2px 4px #000000;" title="prove">
        <i class="fas fa-assistive-listening-systems"></i>
    </a>
    <a href="#" class="btn btn-sm" style="background-color: #9153c2; box-shadow: 2px 2px 4px #000000;" title="audiometrie">
        <i class="fas fa-chart-bar"></i>
    </a>
</div>

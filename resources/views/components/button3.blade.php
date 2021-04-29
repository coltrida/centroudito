<div class="flex space-x-1 justify-around">

    <a href="{{route('client.inserisci', $id)}}" class="btn btn-sm btn-primary mr-1"
            style="box-shadow: 2px 2px 4px #000000;"
            title="modifica">
        <i class="fas fa-edit"></i>
    </a>

    <a href="#" class="btn btn-sm btn-success mr-1" onclick="myFunction({{$id}})"
            title="ricontatta"
            data-bs-toggle="modal"
            data-bs-target="#callModal"
            style="box-shadow: 2px 2px 4px #000000;">
                <i class="fas fa-phone"></i>
    </a>

    <a href="#" class="btn btn-sm btn-warning mr-1" title="note" style="box-shadow: 2px 2px 4px #000000;">
        <i class="far fa-sticky-note"></i>
    </a>
    <a href="#" class="btn btn-sm mr-1" style="background-color: #c2a449; box-shadow: 2px 2px 4px #000000;" title="prove">
        <i class="fas fa-assistive-listening-systems"></i>
    </a>
    <a href="#" class="btn btn-sm" style="background-color: #9153c2; box-shadow: 2px 2px 4px #000000;" title="modifica">
        <i class="fas fa-edit"></i>
    </a>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$nome}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Fissare recall per: <span id="nome_client"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('client.recall')}}" method="POST">
                @csrf
            <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" name="id_client" id="id_client">
                        <input type="date" name="recall"  {{--value="{{$client->datarecall ? $client->datarecall : ''}}"--}} >
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="submit" class="btn btn-primary">Inserisci recall</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function myFunction(id) {
        document.getElementById('id_client').value = id;
    }
</script>

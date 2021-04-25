<div style="display:flex">
    <a href="#" class="btn btn-primary" style="box-shadow: 2px 2px 4px #000000;" data-bs-toggle="modal" data-bs-target="#exampleModal" title="informazioni">
        <i class="fas fa-info-circle"></i>
    </a>
    <a href="#" class="btn btn-success mx-1" title="ricontatta" style="box-shadow: 2px 2px 4px #000000;">
        <i class="fas fa-phone"></i>
    </a>
    <a href="#" class="btn btn-warning mr-1" title="note" style="box-shadow: 2px 2px 4px #000000;">
        <i class="far fa-sticky-note"></i>
    </a>
    <a href="#" class="btn" style="background-color: #c2a449; box-shadow: 2px 2px 4px #000000;">
        <i class="fas fa-assistive-listening-systems"></i>
    </a>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$value->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$value}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
       aria-expanded="false">
        Clienti
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        @foreach($filialiAudio as $filiale)
            <li><a class="dropdown-item"
                   href="{{route('client.index', ['idAudio' => Auth::id(), 'idFiliale' => $filiale->id])}}">{{$filiale->nome}}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endforeach

    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
       aria-expanded="false">
        Magazzini
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        @foreach($filiali as $filiale)
            <li><a class="dropdown-item" href="{{route('magazzinoFiliale.index',  $filiale->id)}}">{{$filiale->nome}}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endforeach
    </ul>
</li>

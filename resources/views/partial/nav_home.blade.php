<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @auth
                    @if(count($filiali) > 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Clienti
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item fw-semibold" href="#">RIEPILOGO</a></li>
                                @endif
                                @foreach($filiali as $item)
                                    <li><a class="dropdown-item" href="{{route('clients', $item->id)}}">{{$item->nome}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Magazzino
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($filiali as $item)
                                    <li><a class="dropdown-item" href="{{route('magazzino', $item->id)}}">{{$item->nome}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Prove
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($filiali as $item)
                                    <li><a class="dropdown-item" href="{{route('listaProve', $item->id)}}">{{$item->nome}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Clienti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Magazzino</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Prove</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex" role="search">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a style="text-decoration: none" href="{{route('logout')}}"
                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <li class="nav-link active">{{ __('Log Out') }}</li>
                            </a>
                        </form>
                    </ul>
                @else
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Log in</a>
                        </li>
                        {{--<li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>--}}
                    </ul>

                @endauth
                <a class="btn btn-outline-success" href="{{route('admin.index')}}">Admin</a>
            </div>
        </div>
    </div>
</nav>

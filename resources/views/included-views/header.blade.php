<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            🍎 VivaFruta
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Sobre nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart4"></i>Carrito
                            @if (session('cart') && count(session('cart')) > 0)
                                <span class="badge rounded-pill bg-danger">
                                    {{ array_sum(array_column(session('cart'), 'quantity')) }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registro</a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            Hola, {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

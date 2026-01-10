@extends('layouts.app')

@section('title', 'Inicio | VivaFruta')

@section('content')
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-success">
            Bienvenido a VivaFruta
        </h1>
        <p class="lead">
            Fruta fresca y de calidad, directa del campo a tu mesa.
        </p>

        @guest
            <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">
                Regístrate y compra
            </a>
        @else
            <a href="{{ route('shop') }}" class="btn btn-success btn-lg mt-3">
                Ir a la tienda
            </a>
        @endguest
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <h3>🍓 Producto fresco</h3>
            <p>Seleccionamos fruta de temporada directamente de productores locales.</p>
        </div>
        <div class="col-md-4">
            <h3>🚚 Envío rápido</h3>
            <p>Entrega rápida para que disfrutes de la fruta en su mejor momento.</p>
        </div>
        <div class="col-md-4">
            <h3>🌱 Compromiso ecológico</h3>
            <p>Reducimos plásticos y apostamos por una producción sostenible.</p>
        </div>
    </div>
@endsection

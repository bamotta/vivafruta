@extends('layouts.app')

@section('content')
    <div class="container text-center py-5">
        <div class="card shadow p-5 border-0">
            <div class="card-body">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h1 class="display-4 fw-bold text-success mt-4">¡Pedido Realizado!</h1>
                <p class="lead">Muchas gracias por confiar en <strong>VivaFruta</strong>. Tu fruta fresca ya se está
                    preparando para el envío.</p>
                <hr class="my-4">
                <div class="alert alert-success">
                    <h5>Resumen de tu compra:</h5>
                    <ul class="list-unstyled">
                        @foreach ($resumen as $item)
                            <li>{{ $item['quantity'] }}kg x {{ $item['name'] }} -
                                {{ number_format($item['price'] * $item['quantity'], 2) }}€</li>
                        @endforeach
                    </ul>
                    <hr>
                    <strong>Total pagado: {{ number_format($total, 2) }}€</strong>
                </div>
                <p class="text-muted">Recibirás un correo con los detalles del pedido y el seguimiento.</p>
                <div class="mt-4">
                    <a href="{{ route('shop') }}" class="btn btn-success btn-lg px-5 shadow-sm">
                        Volver a la tienda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

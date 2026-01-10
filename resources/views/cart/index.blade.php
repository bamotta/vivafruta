@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success mb-4"><i class="bi bi-cart4"></i> Tu Cesta de VivaFruta</h1>

        @if (session('cart') && count(session('cart')) > 0)
            <div class="table-responsive shadow-sm">
                <table class="table table-hover align-middle bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th style="width: 200px;">Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach (session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td class="text-capitalize fw-bold text-success">{{ $details['name'] }}</td>
                                <td>{{ number_format($details['price'], 2) }}€</td>

                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $id }}">

                                        <div class="input-group input-group-sm">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                                min="1" class="form-control text-center">
                                            <button type="submit" class="btn btn-success" title="Actualizar">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>

                                <td class="fw-bold">{{ number_format($details['price'] * $details['quantity'], 2) }}€</td>

                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="5" class="text-end py-4">
                                <h3 class="mb-3">Total: <span class="text-success">{{ number_format($total, 2) }}€</span>
                                </h3>
                                <a href="{{ route('shop') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left"></i> Seguir comprando
                                </a>
                                <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg fw-bold">
                                    Finalizar pedido <i class="bi bi-bag-check"></i>
                                </a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="text-center py-5 shadow-sm bg-light rounded">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                <h3 class="mt-3">Tu carrito está vacío 🍎</h3>
                <p class="text-muted">¡Parece que aún no has elegido tu fruta fresca!</p>
                <a href="{{ route('shop') }}" class="btn btn-success mt-2">
                    Ir a la tienda
                </a>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Tienda | VivaFruta')

@section('content')
    <div class="container">
        {{-- CABECERA --}}
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h1 class="text-success fw-bold mb-0"><i class="bi bi-shop me-2"></i>Nuestra Fruta Fresca</h1>
                <p class="text-muted mb-0">Directamente del campo a tu mesa</p>
            </div>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="btn btn-success fw-bold shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Añadir Nueva Fruta
                    </a>
                @endif
            @endauth
        </div>

        <div class="card bg-light mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('shop') }}" method="GET" class="row g-3 align-items-end">
                    {{-- Buscador --}}
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-success">Buscar</label>
                        <input type="text" name="search" class="form-control" placeholder="Buscar fruta..."
                            value="{{ request('search') }}">
                    </div>

                    {{-- Filtro  --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-success">Precio máximo</label>
                        <select name="max_price" class="form-select">
                            <option value="">Cualquier precio</option>
                            <option value="2" {{ request('max_price') == '2' ? 'selected' : '' }}>Hasta 2.00€/kg
                            </option>
                            <option value="5" {{ request('max_price') == '5' ? 'selected' : '' }}>Hasta 5.00€/kg
                            </option>
                        </select>
                    </div>

                    {{-- Ordenación --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-success">Ordenar</label>
                        <select name="order" class="form-select">
                            <option value="">Ordenar por...</option>
                            <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Precio: Menor
                                a Mayor</option>
                            <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Precio:
                                Mayor a Menor</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-success">Aplicar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        {{-- Badge de Stock --}}
                        <div class="position-absolute top-0 end-0 m-3">
                            @if ($product->stock > 0)
                                <span class="badge bg-light text-success border border-success">{{ $product->stock }} kg
                                    disponibles</span>
                            @else
                                <span class="badge bg-danger">Agotado</span>
                            @endif
                        </div>

                        <div class="card-body pt-5">
                            <h4 class="card-title text-success fw-bold">{{ $product->name }}</h4>
                            <p class="card-text text-muted" style="height: 50px; overflow: hidden;">
                                {{ $product->description }}
                            </p>

                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-link text-decoration-none text-info p-0 mb-3 small">
                                Ver ficha técnica <i class="bi bi-arrow-right"></i>
                            </a>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fs-3 fw-bold text-dark">{{ number_format($product->price, 2) }}€<small
                                        class="fs-6 text-muted">/kg</small></span>

                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success px-4 rounded-pill">
                                            <i class="bi bi-cart-plus me-1"></i> Añadir
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- FOOTER SOLO PARA ADMIN --}}
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <div class="card-footer bg-light border-0 d-flex justify-content-end gap-2 py-3">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    <a href="{{ route('products.confirmDelete', $product->id) }}"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Borrar
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <p class="lead mt-3">Lo sentimos, no hay fruta disponible en este momento.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Un poquito de estilo extra --}}
    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .transition {
            transition: all 0.3s ease;
        }
    </style>
@endsection

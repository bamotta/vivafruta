@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 overflow-hidden">
                    {{-- SECCIÓN DE IMAGEN --}}
                    <div class="position-relative">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="max-height: 400px; width: 100%; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?q=80&w=1000&auto=format&fit=crop"
                                class="card-img-top" alt="Fruta genérica"
                                style="max-height: 400px; width: 100%; object-fit: cover; filter: sepia(0.1);">

                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-secondary opacity-75 shadow-sm">Imagen ilustrativa</span>
                            </div>
                        @endif
                    </div>

                    {{-- SECCIÓN DE TEXTO (Fuera del if/else para que se vea siempre) --}}
                    <div class="card-body p-4">
                        <h1 class="text-success fw-bold">{{ $product->name }}</h1>
                        <p class="lead text-muted">{{ $product->description }}</p>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <span class="h2 fw-bold text-dark mb-0">{{ number_format($product->price, 2) }}€/kg</span>

                            <div class="d-flex gap-2">
                                <a href="{{ route('shop') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>

                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                                            <i class="bi bi-cart-plus me-1"></i> Añadir al carrito
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-danger disabled px-4">Agotado</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
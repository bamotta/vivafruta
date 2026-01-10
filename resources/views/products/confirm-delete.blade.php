@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar Eliminación</h5>
                </div>
                <div class="card-body text-center p-4">
                    <p class="lead">¿Estás seguro de que deseas eliminar permanentemente la siguiente fruta?</p>
                    <h3 class="text-danger fw-bold mb-4">{{ $product->name }}</h3>
                    
                    <div class="alert alert-warning small">
                        <i class="bi bi-info-circle"></i> Esta acción no se puede deshacer y el producto desaparecerá de la tienda.
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        {{-- Botón de Cancelar --}}
                        <a href="{{ route('shop') }}" class="btn btn-secondary px-4">
                            No, mantener producto
                        </a>

                        {{-- Formulario Real de Borrado --}}
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4">
                                Sí, eliminar fruta
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
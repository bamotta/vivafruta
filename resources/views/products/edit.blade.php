@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>Editar Fruta: {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nombre de la fruta</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control"
                                value="{{ $product->price }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock (kg)</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}"
                                required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cambiar imagen (opcional)</label>
                        @if ($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" width="100">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="{{ route('shop') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white fw-bold">
                        <i class="bi bi-plus-circle me-2"></i>Añadir Nueva Fruta a la Tienda
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre del Producto</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Ej: Manzana de Verano" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Precio por kg (€)</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        placeholder="0.00" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Stock Inicial (kg)</label>
                                    <input type="number" name="stock" class="form-control" placeholder="100" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Imagen de la fruta</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Origen, sabor..." required></textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('shop') }}" class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success px-4">Guardar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

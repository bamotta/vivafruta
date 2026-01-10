@extends('layouts.app')

@section('title', 'Contacto | VivaFruta')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center text-center mb-5">
        <div class="col-md-8">
            <h1 class="text-success fw-bold display-4">¿Hablamos?</h1>
            <p class="lead text-muted">Estamos aquí para resolver tus dudas sobre nuestra fruta de temporada.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        {{-- Tarjeta de Información --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="text-success mb-3">
                        <i class="bi bi-geo-alt-fill fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Nuestra Sede</h4>
                    <p class="text-muted">Calle de la Huerta, 12<br>46001, Valencia (España)</p>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Atención al Cliente --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="text-success mb-3">
                        <i class="bi bi-telephone-outbound-fill fs-1"></i>
                    </div>
                    <h4 class="fw-bold">Llámanos</h4>
                    <p class="text-muted">Lunes a Viernes: 9:00 - 18:00</p>
                    <h5 class="text-success fw-bold">+34 960 00 00 00</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
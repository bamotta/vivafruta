<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/test-viva', function () {
    return "El servidor funciona correctamente";
});

Route::get('/arreglar-todo', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return "¡Web lista! Las tablas se han creado. Ve a la página de inicio.";
    } catch (\Exception $e) {
        return "Error al configurar: " . $e->getMessage();
    }
});

// --- 1. RUTAS PÚBLICAS (Cualquiera las ve) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contacto', [HomeController::class, 'contact'])->name('contact');

Auth::routes();

// --- 2. RUTAS PROTEGIDAS (Solo usuarios logueados) ---
Route::middleware(['auth'])->group(function () {
    
    // El usuario normal puede ver productos y usar el carrito
    Route::get('/tienda', [ProductController::class, 'index'])->name('shop');
    
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/carrito/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/carrito/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/finalizar-compra', [CartController::class, 'checkout'])->name('cart.checkout');

    // --- 3. RUTAS DE ADMINISTRADOR (Auth + CheckAdmin) ---
    Route::middleware(['check.admin'])->group(function () {
        Route::get('/productos/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/productos', [ProductController::class, 'store'])->name('products.store');
        Route::get('/productos/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/productos/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/productos/{product}/delete', [ProductController::class, 'confirmDelete'])->name('products.confirmDelete');
        Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('/productos/{product}', [ProductController::class, 'show'])->name('products.show');
});
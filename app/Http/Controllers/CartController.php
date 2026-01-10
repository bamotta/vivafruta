<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Añadir producto al carrito
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = $request->input('quantity', 1); // Coge la cantidad del input, si no hay, usa 1
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                ];
            }
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $product->name . ' añadido al carrito.');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            // Si el usuario pone 0 o menos, lo eliminamos
            if ($request->quantity <= 0) {
                unset($cart[$request->id]);
                $mensaje = "Producto eliminado del carrito.";
            } else {
                $cart[$request->id]["quantity"] = $request->quantity;
                $mensaje = "Cantidad actualizada correctamente.";
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', $mensaje);
        }
    }

    // Eliminar un producto
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        // Ponemos el return fuera del if para que siempre redirija, 
        // incluso si por algún motivo el ID no llegara.
        return redirect()->back()->with('success', 'Carrito actualizado');
    }

    //finalizar compra
    public function checkout()
    {
        if (!session('cart')) return redirect()->route('shop');

        $resumen = session('cart'); // Guardamos los datos
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $resumen));

        session()->forget('cart'); // Borramos carrito

        return view('cart.checkout_success', compact('resumen', 'total'));
    }
}

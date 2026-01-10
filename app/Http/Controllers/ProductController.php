<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // BUSCAR por nombre
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ORDENAR por precio
        if ($request->has('order')) {
            if ($request->order == 'price_asc') $query->orderBy('price', 'asc');
            if ($request->order == 'price_desc') $query->orderBy('price', 'desc');
        }

        $products = $query->get();
        return view('products.shop', compact('products'));
    }

    //mostrar vista detallada de los productos
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('products.create');
    }

    // Guardar nueva fruta
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required'
        ]);

        Product::create($request->all());

        if ($request->hasFile('image')) {
            // Guarda la foto en storage/app/public/products
            $path = $request->file('image')->store('products', 'public');
            // Guardamos la ruta en la base de datos
            $data['image'] = $path;
        }

        Product::create($data);
        return redirect()->route('shop')->with('success', 'Fruta añadida con éxito');
    }

    // Mostrar formulario de edición
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar la fruta en la base de datos
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required'
        ]);

        $product->update($request->all());
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('shop')->with('success', 'Fruta actualizada');
    }


    //Método para mostrar la pregunta "¿Estás seguro?"
    public function confirmDelete(Product $product)
    {
        return view('products.confirm-delete', compact('product'));
    }

    // Borrar fruta
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('shop')->with('success', 'Producto eliminado correctamente');
    }
}

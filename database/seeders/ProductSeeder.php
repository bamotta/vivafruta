<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Manzana Ecológica',
            'description' => 'Directa de los campos de Lleida, crujiente y dulce.',
            'price' => 2.50,
            'stock' => 50
        ]);

        Product::create([
            'name' => 'Plátano de Canarias',
            'description' => 'Sabor intenso con el punto justo de maduración.',
            'price' => 1.95,
            'stock' => 100
        ]);

        Product::create([
            'name' => 'Fresones de Huelva',
            'description' => 'Caja de 500g de fresones rojos y sabrosos.',
            'price' => 3.20,
            'stock' => 30
        ]);
    }
}

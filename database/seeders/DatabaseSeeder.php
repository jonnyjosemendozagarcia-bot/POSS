<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Producto::query()->delete();
        Categoria::query()->delete();
        Empresa::query()->delete();

        // Crear Empresas
        $empresa1 = Empresa::create([
            'nombre' => 'Bodega El Sol',
            'ruc' => '20123456789',
            'direccion' => 'Av. Principal 123, Lima',
            'telefono' => '987654321',
            'email' => 'contacto@bodegaelsol.com',
            'estado' => 1
        ]);

        $empresa2 = Empresa::create([
            'nombre' => 'Minimarket Luna',
            'ruc' => '20987654321',
            'direccion' => 'Jr. Comercio 456, Lima',
            'telefono' => '912345678',
            'email' => 'ventas@minimartluna.com',
            'estado' => 1
        ]);

        // Crear Categorías para Empresa 1
        $catBebidas = Categoria::create([
            'nombre' => 'Bebidas',
            'descripcion' => 'Bebidas gaseosas, jugos y agua',
            'estado' => 1
        ]);

        $catSnacks = Categoria::create([
            'nombre' => 'Snacks',
            'descripcion' => 'Galletas, papas fritas y golosinas',
            'estado' => 1
        ]);

        $catLacteos = Categoria::create([
            'nombre' => 'Lácteos',
            'descripcion' => 'Leche, yogurt y quesos',
            'estado' => 1
        ]);

        $catAbarrotes = Categoria::create([
            'nombre' => 'Abarrotes',
            'descripcion' => 'Arroz, fideos, aceite y productos básicos',
            'estado' => 1
        ]);

        $catLimpieza = Categoria::create([
            'nombre' => 'Limpieza',
            'descripcion' => 'Productos de limpieza para el hogar',
            'estado' => 1
        ]);

        // Productos - Bebidas
        Producto::create([
            'codigo' => 'BEB001',
            'nombre' => 'Coca Cola 1.5L',
            'descripcion' => 'Gaseosa Coca Cola 1.5 litros',
            'categoria_id' => $catBebidas->id,
            'precio_compra' => 3.50,
            'precio_venta' => 5.00,
            'stock_actual' => 50,
            'stock_minimo' => 10,
            'unidad_medida' => 'Unidad',
            'codigo_barras' => '7750100001234',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'BEB002',
            'nombre' => 'Inca Kola 2L',
            'descripcion' => 'Gaseosa Inca Kola 2 litros',
            'categoria_id' => $catBebidas->id,
            'precio_compra' => 4.00,
            'precio_venta' => 5.50,
            'stock_actual' => 40,
            'stock_minimo' => 10,
            'unidad_medida' => 'Unidad',
            'codigo_barras' => '7750100002345',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'BEB003',
            'nombre' => 'Agua San Luis 625ml',
            'descripcion' => 'Agua mineral sin gas',
            'categoria_id' => $catBebidas->id,
            'precio_compra' => 0.80,
            'precio_venta' => 1.50,
            'stock_actual' => 100,
            'stock_minimo' => 20,
            'unidad_medida' => 'Unidad',
            'codigo_barras' => '7750100003456',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        // Productos - Snacks
        Producto::create([
            'codigo' => 'SNK001',
            'nombre' => 'Papas Lays Clásicas 180g',
            'descripcion' => 'Papas fritas sabor original',
            'categoria_id' => $catSnacks->id,
            'precio_compra' => 4.50,
            'precio_venta' => 7.00,
            'stock_actual' => 30,
            'stock_minimo' => 5,
            'unidad_medida' => 'Unidad',
            'codigo_barras' => '7750200001234',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'SNK002',
            'nombre' => 'Galletas Oreo 432g',
            'descripcion' => 'Galletas chocolate con crema',
            'categoria_id' => $catSnacks->id,
            'precio_compra' => 6.00,
            'precio_venta' => 9.00,
            'stock_actual' => 25,
            'stock_minimo' => 5,
            'unidad_medida' => 'Paquete',
            'codigo_barras' => '7750200002345',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        // Productos - Lácteos
        Producto::create([
            'codigo' => 'LAC001',
            'nombre' => 'Leche Gloria Entera 1L',
            'descripcion' => 'Leche UHT entera',
            'categoria_id' => $catLacteos->id,
            'precio_compra' => 3.80,
            'precio_venta' => 5.50,
            'stock_actual' => 60,
            'stock_minimo' => 15,
            'unidad_medida' => 'Litro',
            'codigo_barras' => '7750300001234',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'LAC002',
            'nombre' => 'Yogurt Gloria Fresa 1L',
            'descripcion' => 'Yogurt sabor fresa',
            'categoria_id' => $catLacteos->id,
            'precio_compra' => 4.50,
            'precio_venta' => 7.00,
            'stock_actual' => 35,
            'stock_minimo' => 10,
            'unidad_medida' => 'Litro',
            'codigo_barras' => '7750300002345',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        // Productos - Abarrotes
        Producto::create([
            'codigo' => 'ABA001',
            'nombre' => 'Arroz Paisana 1kg',
            'descripcion' => 'Arroz superior',
            'categoria_id' => $catAbarrotes->id,
            'precio_compra' => 3.20,
            'precio_venta' => 4.50,
            'stock_actual' => 80,
            'stock_minimo' => 20,
            'unidad_medida' => 'Kilogramo',
            'codigo_barras' => '7750400001234',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'ABA002',
            'nombre' => 'Fideos Don Vittorio 500g',
            'descripcion' => 'Fideos spaghetti',
            'categoria_id' => $catAbarrotes->id,
            'precio_compra' => 2.00,
            'precio_venta' => 3.50,
            'stock_actual' => 70,
            'stock_minimo' => 15,
            'unidad_medida' => 'Paquete',
            'codigo_barras' => '7750400002345',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'ABA003',
            'nombre' => 'Aceite Primor 1L',
            'descripcion' => 'Aceite vegetal',
            'categoria_id' => $catAbarrotes->id,
            'precio_compra' => 8.50,
            'precio_venta' => 12.00,
            'stock_actual' => 45,
            'stock_minimo' => 10,
            'unidad_medida' => 'Litro',
            'codigo_barras' => '7750400003456',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        // Productos - Limpieza
        Producto::create([
            'codigo' => 'LIM001',
            'nombre' => 'Detergente Ariel 900g',
            'descripcion' => 'Detergente en polvo',
            'categoria_id' => $catLimpieza->id,
            'precio_compra' => 8.00,
            'precio_venta' => 12.00,
            'stock_actual' => 40,
            'stock_minimo' => 8,
            'unidad_medida' => 'Bolsa',
            'codigo_barras' => '7750500001234',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        Producto::create([
            'codigo' => 'LIM002',
            'nombre' => 'Lavavajilla Ayudín 500ml',
            'descripcion' => 'Lavavajilla líquido limón',
            'categoria_id' => $catLimpieza->id,
            'precio_compra' => 3.50,
            'precio_venta' => 5.50,
            'stock_actual' => 50,
            'stock_minimo' => 10,
            'unidad_medida' => 'Unidad',
            'codigo_barras' => '7750500002345',
            'empresa_id' => $empresa1->id,
            'estado' => 1
        ]);

        echo "✅ Base de datos poblada exitosamente!\n";
        echo "📊 Se crearon:\n";
        echo "   - 2 Empresas\n";
        echo "   - 5 Categorías\n";
        echo "   - 13 Productos\n";
    }
}

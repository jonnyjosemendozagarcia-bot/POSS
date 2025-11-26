<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $productos = Producto::with(['categoria', 'empresa'])->get();

        return response()->json($productos, Response::HTTP_OK);
    }
    
    public function __construct()
    {
    request()->headers->set('Accept', 'application/json');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:100|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'categoria_id' => 'nullable|exists:categorias,id',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'unidad_medida' => 'nullable|string|max:50',
            'codigo_barras' => 'nullable|string|max:100',
            'empresa_id' => 'required|exists:empresas,id',
            'activo' => 'nullable|in:0,1',
        ]);

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::with(['categoria', 'empresa'])->find($id);
        
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($producto, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:100|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'categoria_id' => 'nullable|exists:categorias,id',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'unidad_medida' => 'nullable|string|max:50',
            'codigo_barras' => 'nullable|string|max:100',
            'empresa_id' => 'required|exists:empresas,id',
            'activo' => 'nullable|in:0,1',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $producto->update($validated);

        return response()->json($producto, Response::HTTP_OK);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], Response::HTTP_OK);
    }
}

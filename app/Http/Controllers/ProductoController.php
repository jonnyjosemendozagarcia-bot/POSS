<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with(['categoria', 'empresa'])->get();
        return $this->sendResponse($productos, 'Productos obtenidos exitosamente');
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
            'estado' => 'nullable|in:0,1',
        ]);

        $producto = Producto::create($validated);
        return $this->sendResponse($producto, 'Producto creado exitosamente', 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::with(['categoria', 'empresa'])->find($id);
        
        if (!$producto) {
            return $this->sendError('Producto no encontrado', [], 404);
        }

        return $this->sendResponse($producto, 'Producto obtenido exitosamente');
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
            'estado' => 'nullable|in:0,1',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return $this->sendError('Producto no encontrado', [], 404);
        }

        $producto->update($validated);
        return $this->sendResponse($producto, 'Producto actualizado exitosamente');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return $this->sendError('Producto no encontrado', [], 404);
        }

        $producto->delete();
        return $this->sendResponse(null, 'Producto eliminado correctamente');
    }
}

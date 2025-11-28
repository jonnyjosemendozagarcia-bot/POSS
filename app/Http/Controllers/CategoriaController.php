<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Categoria;

class CategoriaController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::with('empresa')->get();

        return response()->json($categorias, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa_id' => 'nullable|exists:empresas,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'nullable|in:0,1',  // 0 = Inactivo, 1 = Activo
        ]);
        $categoria = Categoria::create($validated);

        return response()->json($categoria, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::with('empresa')->find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($categoria, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'empresa_id' => 'nullable|exists:empresas,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'nullable|in:0,1',  // 0 = Inactivo, 1 = Activo
        ]);

        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], Response::HTTP_NOT_FOUND);
        }
        $categoria->update($validated);

        return response()->json($categoria, Response::HTTP_OK);

    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], Response::HTTP_NOT_FOUND);
        }
        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente'], Response::HTTP_OK);

    }
}

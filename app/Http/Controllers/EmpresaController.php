<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return $this->sendResponse($empresas, 'Empresas obtenidas exitosamente');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:500',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'logo_base64' => 'nullable|string',
        ]);

        $empresa = Empresa::create($validated);

        return $this->sendResponse($empresa, 'Empresa creada exitosamente', 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return $this->sendError('Empresa no encontrada', [], 404);
        }

        return $this->sendResponse($empresa, 'Empresa obtenida exitosamente');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return $this->sendError('Empresa no encontrada', [], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:500',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'logo_base64' => 'nullable|string',
        ]);

        $empresa->update($validated);

        return $this->sendResponse($empresa, 'Empresa actualizada exitosamente');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return $this->sendError('Empresa no encontrada', [], 404);
        }

        $empresa->delete();
        
        return $this->sendResponse(null, 'Empresa eliminada correctamente');
    }
}

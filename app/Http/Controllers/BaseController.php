<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function __construct()
    {
        request()->headers->set('Accept', 'application/json');
    }

    /**
     * 🎯 Respuesta exitosa estándar
     */
    protected function sendResponse($data, $message = 'Operación exitosa', $code = 200)
    {
        return response()->json([
            'success' => true,
            'codigo' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * ❌ Respuesta de error estándar
     */
    protected function sendError($message, $errors = [], $code = 400)
    {
        return response()->json([
            'success' => false,
            'codigo' => $code,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
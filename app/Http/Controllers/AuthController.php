<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * 🔐 Registrar un nuevo usuario
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ], 'Usuario registrado exitosamente', 201);
    }

    /**
     * 🔓 Login de usuario
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar por email O por name
        $user = User::where('email', $validated['login'])
                    ->orWhere('name', $validated['login'])
                    ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->sendError('Credenciales incorrectas', [], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ], 'Login exitoso');
    }

    /**
     * 🚪 Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'Sesión cerrada correctamente');
    }
}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
     {
         // Validación
         $credentials = [
             "email" => $request->email,
             "password" => $request->password,
         ];
     
         $remember = $request->has('remember');
     
         // Intentar autenticar
         if (Auth::attempt($credentials, $remember)) {
             $user = Auth::User();
     
                 // Generar token para el usuario autenticado
                 $token = $user->createToken('token-name')->plainTextToken;
     
                 return response()->json([
                     'token' => $token,
                     'user' => $user
                 ], 200);
           
         } else {
             // Credenciales incorrectas
             return response()->json(['message' => '¡Credenciales incorrectas!'], 400);
         }
     }

     public function logout(Request $request)
     {
         // Verifica si hay un usuario autenticado
         $user = $request->user();
         
         if ($user) {
             // Revocar todos los tokens del usuario autenticado
             $user->tokens()->delete();
     
             return response()->json(['message' => 'Sesión cerrada en todos los dispositivos'], 200);
         }
     
         return response()->json(['message' => 'No se encontró un usuario autenticado'], 401);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

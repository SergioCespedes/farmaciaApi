<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $usuario = Usuario:: where('activo', 1)->get();
            return response()->json(['success' => true, 'data' => $usuario]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al obtener los usuarios: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'cedula' => 'required|string',
                'nombre_usuario' => 'required|string',
                'apellido_usuario' => 'required|string',
                'telefono' => 'required|integer',
                'email' => 'required|string',
            ]);

            $usuario = new Usuario([
                'cedula' => $request->cedula,
                'nombre_usuario' => $request->nombre_usuario,
                'apellido_usuario' => $request->apellido_usuario,
                'telefono' => $request->telefono,
                'email' => $request->email
            ]);
            $usuario->save();

            return response()->json(['message' => 'Usuario creado con éxito', 'Usuario' => $usuario], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al crear el usuario: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $usuario = Usuario::findOrFail($id);

            $request->validate([
                'cedula' => 'required|string',
                'nombre_usuario' => 'required|string',
                'apellido_usuario' => 'required|string',
                'telefono' => 'required|integer',
                'email' => 'required|string',
                'activo' => 'required|integer'
            ]);
            $usuario->cedula = $request->cedula;
            $usuario->nombre_usuario = $request->nombre_usuario;
            $usuario->apellido_usuario = $request->apellido_usuario;
            $usuario->telefono = $request->telefono;
            $usuario->email = $request->email;
            $usuario->activo = $request->activo;
            $usuario->save();

            return response()->json(['message' => 'Usuario actualizado con éxito', 'Usuario' => $usuario], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al actualizar el usuario: ' . $e->getMessage()], 500);
        }

    }


}

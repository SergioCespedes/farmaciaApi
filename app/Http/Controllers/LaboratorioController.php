<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $laboratorio = Laboratorio:: where('activo', 1)->get();
            return response()->json(['success' => true, 'data' => $laboratorio]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al obtener los laboratorios: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'nombre_laboratorio' => 'required|string'
            ]);

            $laboratorio = new Laboratorio([
                'nombre_laboratorio' => $request->nombre_laboratorio
            ]);
            $laboratorio->save();

            return response()->json(['message' => 'Laboratorio creado con éxito', 'Laboratorio' => $laboratorio], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al crear el laboratorio: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $laboratorio = Laboratorio::findOrFail($id);

            $request->validate([
                'nombre_laboratorio' => 'required|string',
                'activo' => 'required|integer'
            ]);
            $laboratorio->nombre_laboratorio = $request->nombre_laboratorio;
            $laboratorio->activo = $request->activo;
            $laboratorio->save();

            return response()->json(['message' => 'Laboratorio actualizado con éxito', 'Laboratorio' => $laboratorio], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al actualizar el laboratorio: ' . $e->getMessage()], 500);
        }

    }


}

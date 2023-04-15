<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use App\Models\Producto;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $producto = Producto:: where('activo', 1)->get();
            return response()->json(['success' => true, 'data' => $producto]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al obtener los productos: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'categoria' => 'required|string',
                'descripcion' => 'required|string',
                'principioActivo' => 'required|string',
                'stock' => 'required|integer',
                'precio' => 'required|numeric',
                'fechaVencimiento' => 'required|date',
                'imagen' => 'nullable|string',
                'id_laboratorio' => 'required|exists:laboratorios,id'
            ]);

            $producto = new Producto([
                'nombre' => $request->nombre,
                'categoria' => $request->categoria,
                'descripcion' => $request->descripcion,
                'principioActivo' => $request->principioActivo,
                'stock' => $request->stock,
                'precio' => $request->precio,
                'fechaVencimiento' => $request->fechaVencimiento,
                'imagen' => $request->imagen,
                'id_laboratorio' => $request->id_laboratorio,
            ]);
            $producto->save();

            return response()->json(['message' => 'Producto creado con éxito', 'Producto' => $producto], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al crear el producto: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {

            $producto = Producto::find($id);

            $request->validate([
                'nombre' => 'required|string',
                'categoria' => 'required|string',
                'descripcion' => 'required|string',
                'principioActivo' => 'required|string',
                'stock' => 'required|integer',
                'precio' => 'required|numeric',
                'activo' => 'required|integer',
                'fechaVencimiento' => 'required|date',
                'imagen' => 'nullable|string',
                'id_laboratorio' => 'required|exists:laboratorios,id'
            ]);
            $producto->nombre = $request->nombre;
            $producto->categoria = $request->categoria;
            $producto->descripcion = $request->descripcion;
            $producto->principioActivo = $request->principioActivo;
            $producto->stock = $request->stock;
            $producto->precio = $request->precio;
            $producto->activo = $request->activo;
            $producto->fechaVencimiento = $request->fechaVencimiento;
            $producto->imagen = $request->imagen;
            $producto->id_laboratorio = $request->id_laboratorio;

            $producto->save();

            return response()->json(['message' => 'Producto actualizado con éxito', 'Producto' => $producto], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Hubo un problema al actualizar el producto: ' . $e->getMessage()], 500);
        }
    }
}

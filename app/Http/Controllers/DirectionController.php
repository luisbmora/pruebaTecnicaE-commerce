<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index()
    {
        $direcciones = Direction::get();
        return response()->json($direcciones, 200);
    }

    public function store(Request $request)
    {
        try {
            $direccion = Direction::create($request->all()); // Utiliza todos los datos enviados
            return response()->json([
                'message' => 'Dirección creada exitosamente',
                'direccion' => $direccion,
            ], 201);
        } catch (Exception $e) {
            \Log::error('Error al crear dirección: ' . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al crear la dirección',
            ], 500);
        }
    
    }

    public function show($id)
    {
        $direccion = Direction::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        return response()->json($direccion, 200);
    }

    public function update(Request $request, $id)
    {
        $direccion = Direction::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        $data = $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'domicilio' => 'required|max:255',
            'correo_electronico' => "required|email|unique:direcciones,correo_electronico,{$id}",
        ]);

        $direccion->update($data);
        return response()->json(['message' => 'Dirección actualizada', 'direccion' => $direccion], 200);
    }

    public function destroy($id)
    {
        $direccion = Direction::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::all();
        return response()->json($direcciones, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'domicilio' => 'required|max:255',
            'correo_electronico' => 'required|email|unique:direcciones',
        ]);

        $direccion = Direccion::create($data);
        return response()->json(['message' => 'Dirección creada', 'direccion' => $direccion], 201);
    }

    public function show($id)
    {
        $direccion = Direccion::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        return response()->json($direccion, 200);
    }

    public function update(Request $request, $id)
    {
        $direccion = Direccion::find($id);

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
        $direccion = Direccion::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada'], 200);
    }
}

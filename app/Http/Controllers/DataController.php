<?php
namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return response()->json(Direccion::all());
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
        return response()->json(['message' => 'Dirección creada', 'direccion' => $direccion]);
    }

    public function show($id)
    {
        $direccion = Direccion::findOrFail($id);
        return response()->json($direccion);
    }

    public function update(Request $request, $id)
    {
        $direccion = Direccion::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'domicilio' => 'required|max:255',
            'correo_electronico' => "required|email|unique:direcciones,correo_electronico,{$id}",
        ]);

        $direccion->update($data);
        return response()->json(['message' => 'Dirección actualizada', 'direccion' => $direccion]);
    }

    public function destroy($id)
    {
        Direccion::destroy($id);
        return response()->json(['message' => 'Dirección eliminada']);
    }
}

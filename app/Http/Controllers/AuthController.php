<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login exitoso', 'user' => Auth::user()]);
        }

        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }
}

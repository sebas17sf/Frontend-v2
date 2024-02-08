<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// Importante: Agregar esta línea


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $response = Http::get('http://localhost:3000/Usuarios', [
                'username' => $request->username,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $usuarios = $response->json();

                $usuario = collect($usuarios)->where('username', $request->username)
                    ->where('password', $request->password)->first();

                if ($usuario) {
                     if ($usuario['tipo'] == 'Admin') {
                         return redirect()->route('admin.index')->with('success', 'Usuario autenticado con éxito');
                    } else {
                         return redirect()->route('login.index')->with('error', 'Tipo de usuario no válido');
                    }
                } else {
                    return back()->with('error', 'Usuario o contraseña incorrectos');
                }
            } else {
                \Log::error('API Response Error: ' . $response->body());
                return back()->with('error', 'Error al iniciar sesión');
            }
        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());
            return back()->with('error', 'Error al procesar la solicitud');
        }
    }






    public function register()
    {
        return view('login.register');
    }

    public function createRegister(Request $request)
    {
        $username = $request->input('username');

        $authResponse = Http::get('http://localhost:3000/Usuarios', [
            'username' => $username,
        ]);

        if ($authResponse->successful()) {
            $usuarios = $authResponse->json();

            $existingUser = collect($usuarios)->where('username', $username)->first();

            if ($existingUser) {
                return redirect()->route('login.index')->with('error', 'El usuario ya existe. Por favor, inicia sesión.');
            }
        }

        $idUsuario = mt_rand();

        $request->merge([
            'id_usuario' => $idUsuario,
            'tipo' => 'estudiante',
            'dataCreacion' => now()->toDateString(),
        ]);

        $request->validate([
            'id_usuario' => 'required',
            'username' => 'required',
            'password' => 'required',
            'tipo' => 'required',
            'dataCreacion' => 'required',
        ]);

        try {
            $response = Http::post('http://localhost:3000/Usuarios', $request->all());

            if ($response->successful()) {
                return redirect()->route('login.index')->with('success', 'Usuario registrado con éxito');
            } else {
                return redirect()->route('login.index')->with('error', 'Error al registrar el usuario');
            }
        } catch (\Exception $e) {
            return redirect()->route('login.index')->with('error', 'Error al procesar la solicitud');
        }
    }


}


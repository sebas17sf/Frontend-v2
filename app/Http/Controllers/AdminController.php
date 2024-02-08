<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{

    public function index()
    {
        $response = Http::get('http://localhost:3000/Usuarios');

        if ($response->successful()) {
            $usuarios = collect($response->json())->where('estado', 'En proceso');

            return view('admin.index', ['usuarios' => $usuarios]);
        } else {
             return back()->with('error', 'Error al obtener los usuarios');
        }
    }

    public function eliminar($correoElectronico)
    {
        try {
            $response = Http::delete('http://localhost:3000/eliminar-usuario', [
                'correoElectronico' => $correoElectronico,
            ]);
    
            if ($response->successful()) {
                return back()->with('success', 'Usuario eliminado correctamente');
            } else {
                 return back()->with('error', 'Error al eliminar el usuario');
            }
        } catch (\Exception $e) {
             return back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function Verificar($correoElectronico)
    {
        try {
            $response = Http::put('http://localhost:3000/actualizar-estado', [
                'correoElectronico' => $correoElectronico,
                'estado' => 'Verificado',
            ]);
    
            if ($response->successful()) {
                return back()->with('success', 'Usuario aceptado correctamente');
            } else {
                 return back()->with('error', 'Error al aceptar el usuario');
            }
        } catch (\Exception $e) {
             return back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function index2()
    {
        $response = Http::get('http://localhost:3000/Usuarios');

        if ($response->successful()) {
            $usuarios = collect($response->json())->where('estado', 'Verificado');

            return view('admin.index2', ['usuarios' => $usuarios]);
        } else {
             return back()->with('error', 'Error al obtener los usuarios');
        }
    }

    public function eliminar2($correoElectronico)
    {
        try {
            $response = Http::put('http://localhost:3000/actualizar-estado', [
                'correoElectronico' => $correoElectronico,
                'estado' => 'En proceso',
            ]);
    
            if ($response->successful()) {
                return back()->with('success', 'Usuario Rechazado correctamente');
            } else {
                 return back()->with('error', 'Error al aceptar el usuario');
            }
        } catch (\Exception $e) {
             return back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function aceptar($correoElectronico)
    {
        try {
            $response = Http::put('http://localhost:3000/actualizar-estado', [
                'correoElectronico' => $correoElectronico,
                'estado' => 'Vinculacion',
            ]);
    
            if ($response->successful()) {
                return back()->with('success', 'Usuario aceptado correctamente');
            } else {
                 return back()->with('error', 'Error al aceptar el usuario');
            }
        } catch (\Exception $e) {
             return back()->with('error', 'Error al procesar la solicitud');
        }
    }
    

}

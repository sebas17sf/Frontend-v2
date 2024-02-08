<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');

    }

    public function createRegister(Request $request)
    {
        $request->merge(['estado' => 'En proceso']);
        $idUsuario = rand();
        $request->merge(['id_usuario' => $idUsuario]);


        $request->validate([
            'nombreCompleto' => 'required',
            'cedula' => 'required',
            'correoElectronico' => 'required|email',
            'ciudad' => 'required',
            'cohorte' => 'required',
            'periodo' => 'required',
            'carrera' => 'required',
        ]);

        try {
            $response = Http::get('http://localhost:3000/Usuarios');

            if (!$response->successful()) {
                 return back()->with('error', 'Error al obtener los usuarios');
            }

            $existingRecords = collect($response->json())->where('estado', 'En proceso');

            $duplicateRecord = $existingRecords->first(function ($record) use ($request) {
                return $record['nombreCompleto'] == $request->nombreCompleto &&
                    $record['cedula'] == $request->cedula &&
                    $record['correoElectronico'] == $request->correoElectronico;
            });

            if ($duplicateRecord) {
                return back()->with('error', 'Ya existe un registro en proceso con estos datos.');
            }

            $response = Http::post('http://localhost:3000/Usuarios', [
                'id_usuario' => $idUsuario,
                'nombreCompleto' => $request->nombreCompleto,
                'cedula' => $request->cedula,
                'correoElectronico' => $request->correoElectronico,
                'ciudad' => $request->ciudad,
                'cohorte' => $request->cohorte,
                'periodo' => $request->periodo,
                'carrera' => $request->carrera,
                'estado' => $request->estado,
            ]);

            if ($response->successful()) {
                return redirect()->route('login.index')->with('success', 'Usuario registrado con éxito');
            } else {
                 return back()->with('error', 'Error al registrar el usuario');
            }
        } catch (\Exception $e) {
             return back()->with('error', 'Error al procesar la solicitud');
        }
    }



}

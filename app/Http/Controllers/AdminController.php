<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\EstadoEstudianteActualizado;
use App\Mail\RechazoEstudiante;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Mail\UsuarioAceptado;
use App\Mail\verificacion;

class AdminController extends Controller
{

    public function index()
    {
        $response = Http::get('http://18.216.192.159:3000/usuarios');

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
            $response = Http::get('http://18.216.192.159:3000/Usuarios');

            if ($response->successful()) {
                $usuarios = collect($response->json());

                $usuario = $usuarios->firstWhere('correoElectronico', $correoElectronico);

                if ($usuario) {
                    try {
                        Mail::to($usuario['correoElectronico'])->send(new RechazoEstudiante($usuario));
                    } catch (\Exception $e) {
                        session()->flash('error', 'Error al enviar el correo de rechazo: ' . $e->getMessage());
                        return back()->with('error', 'Error al enviar el correo de rechazo');
                    }

                    $responseDelete = Http::delete('http://18.216.192.159:3000/eliminar-usuario', [
                        'correoElectronico' => $correoElectronico,
                    ]);

                    if ($responseDelete->successful()) {
                        return back()->with('success', 'Usuario eliminado correctamente');
                    } else {
                        return back()->with('error', 'Error al eliminar el usuario');
                    }
                } else {
                    return back()->with('error', 'Usuario no encontrado');
                }
            } else {
                return back()->with('error', 'Error al obtener los datos de los usuarios');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar la solicitud');
        }
    }




    public function Verificar($correoElectronico)
    {
        try {
            $response = Http::get('http://18.216.192.159:3000/Usuarios', [
                'correoElectronico' => $correoElectronico,
            ]);

            if ($response->successful()) {
                $usuarios = $response->json();

                $usuario = collect($usuarios)->firstWhere('correoElectronico', $correoElectronico);

                if ($usuario) {
                    $responseUpdate = Http::put('http://18.216.192.159:3000/actualizar-estado', [
                        'correoElectronico' => $usuario['correoElectronico'],
                        'estado' => 'Verificado',
                    ]);

                    if ($responseUpdate->successful()) {
                        Mail::to($usuario['correoElectronico'])->send(new EstadoEstudianteActualizado($usuario));

                        return redirect()->back()->with('success', 'Usuario aceptado correctamente');
                    } else {
                        return redirect()->back()->with('error', 'Error al aceptar el usuario');
                    }
                } else {
                    return redirect()->back()->with('error', 'Usuario no encontrado');
                }
            } else {
                return redirect()->back()->with('error', 'Error al obtener los datos de los usuarios');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud');
        }
    }


    public function index2()
    {
        $response = Http::get('http://18.216.192.159:3000/Usuarios');

        if ($response->successful()) {
            $usuarios = collect($response->json())->where('estado', 'Verificado');

            return view('admin.index2', ['usuarios' => $usuarios]);
        } else {
            return back()->with('error', 'Error al obtener los usuarios');
        }
    }


    public function index3()
    {
        $response = Http::get('http://18.216.192.159:3000/Usuarios');

        if ($response->successful()) {
            $usuarios = collect($response->json())->where('estado', 'Vinculacion');

            return view('admin.index3', ['usuarios' => $usuarios]);
        } else {
            return back()->with('error', 'Error al obtener los usuarios');
        }
    }

    public function eliminar2($correoElectronico)
    {
        try {
            $response = Http::get('http://18.216.192.159:3000/Usuarios', [
                'correoElectronico' => $correoElectronico,
            ]);

            if ($response->successful()) {
                $usuarios = $response->json();

                $usuario = collect($usuarios)->firstWhere('correoElectronico', $correoElectronico);

                if ($usuario) {
                    $responseUpdate = Http::put('http://18.216.192.159:3000/actualizar-estado', [
                        'correoElectronico' => $usuario['correoElectronico'],
                        'estado' => 'En proceso',
                    ]);

                    if ($responseUpdate->successful()) {
                        Mail::to($usuario['correoElectronico'])->send(new verificacion($usuario));
 
                        return redirect()->back()->with('success', 'Usuario aceptado correctamente');
                    } else {
                        return redirect()->back()->with('error', 'Error al aceptar el usuario');
                    }
                } else {
                    return redirect()->back()->with('error', 'Usuario no encontrado');
                }
            } else {
                return redirect()->back()->with('error', 'Error al obtener los datos de los usuarios');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function aceptar($correoElectronico)
    {
        try {
            $response = Http::get('http://18.216.192.159:3000/Usuarios', [
                'correoElectronico' => $correoElectronico,
            ]);

            if ($response->successful()) {
                $usuarios = $response->json();

                $usuario = collect($usuarios)->firstWhere('correoElectronico', $correoElectronico);

                if ($usuario) {
                    $responseUpdate = Http::put('http://18.216.192.159:3000/actualizar-estado', [
                        'correoElectronico' => $usuario['correoElectronico'],
                        'estado' => 'Vinculacion',
                    ]);

                    if ($responseUpdate->successful()) {
                        Mail::to($usuario['correoElectronico'])->send(new UsuarioAceptado($usuario));
 
                        return redirect()->back()->with('success', 'Usuario aceptado correctamente');
                    } else {
                        return redirect()->back()->with('error', 'Error al aceptar el usuario');
                    }
                } else {
                    return redirect()->back()->with('error', 'Usuario no encontrado');
                }
            } else {
                return redirect()->back()->with('error', 'Error al obtener los datos de los usuarios');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function descargar($correoElectronico)
    {
        try {
            $response = Http::get('http://18.216.192.159:3000/Usuarios', ['correoElectronico' => $correoElectronico]);

            if ($response->successful()) {
                // Decodifica la respuesta JSON
                $usuarios = $response->json();

                $usuario = collect($usuarios)->firstWhere('correoElectronico', $correoElectronico);

                if ($usuario) {
                    if (isset($usuario['foto']) && !empty($usuario['foto']) && $usuario['foto'] !== 'nada') {
                        $nombreArchivo = Str::slug($usuario['nombreCompleto'], '_') . '.jpg';

                        return Response::make(base64_decode($usuario['foto']), 200, [
                            'Content-Disposition' => 'attachment; filename=' . $nombreArchivo,
                        ]);
                    } else {
                        return back()->with('error', 'No existe evidencia para descargar.');
                    }
                } else {
                    return back()->with('error', 'No se encontró un usuario con el correo electrónico proporcionado.');
                }
            } else {
                return back()->with('error', 'Error al obtener los datos del usuario desde la API.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar la solicitud.');
        }
    }




}

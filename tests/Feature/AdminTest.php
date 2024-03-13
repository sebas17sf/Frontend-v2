<?php
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\RechazoEstudiante;
use App\Mail\verificacion;
use App\Mail\EstadoEstudianteActualizado;


class AdminTest extends TestCase
{
    public function testIndexSuccess()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['estado' => 'En proceso', 'usuario' => 'usuario1'],
                ]),
                200
            ),
        ]);

        try {
            $response = $this->get('/admin');
            $response->assertStatus(200);
            $response->assertViewIs('admin.index');
            $response->assertViewHas('usuarios');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }

    }



    public function testIndexApiError()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response([], 500),
        ]);

        try {
            $response = $this->get('/admin');
            $response->assertSessionHas('error', 'Error al obtener los usuarios');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->fail('No se esperaba una excepción');
        }
    }

    public function testIndexException()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => new \Exception('Error de red'),
        ]);

        try {
            $response = $this->get('/admin');
            $response->assertSessionHas('error', 'Error al obtener los usuarios');
            $response->assertRedirect();
        } catch (\Exception $e) {

            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testEliminarSuccess()
    {
        Mail::fake();
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['correoElectronico' => 'usuario1'],
                ]),
                200
            ),
            'http://localhost:3000/eliminar-usuario' => Http::response([], 200),
        ]);

        try {
            $response = $this->delete('/admin/eliminar/usuario1');
            $response->assertSessionHas('success', 'Usuario eliminado correctamente');
            $response->assertRedirect();
            Mail::assertSent(RechazoEstudiante::class);
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testEliminarUserNotFound()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([]),
                200
            ),
        ]);

        try {
            $response = $this->delete('/admin/eliminar/usuario1');
            $response->assertSessionHas('error', 'Usuario no encontrado');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testEliminarApiError()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response([], 500),
        ]);

        try {
            $response = $this->delete('/admin/eliminar/usuario1');
            $response->assertSessionHas('error', 'Error al obtener los datos de los usuarios');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testEliminarApiErrorDelete()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['correoElectronico' => 'usuario1'],
                ]),
                200
            ),
            'http://localhost:3000/eliminar-usuario' => Http::response([], 500),
        ]);

        try {
            $response = $this->delete('/admin/eliminar/usuario1');
            $response->assertSessionHas('error', 'Error al eliminar el usuario');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    ///////////////////////Verificar
    public function testVerificarSuccess()
    {
        Mail::fake();
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['correoElectronico' => 'usuario1'],
                ]),
                200
            ),
            'http://localhost:3000/actualizar-usuario' => Http::response([], 200),
        ]);

        try {
            $response = $this->post('/admin/aceptar/usuario1');
            $response->assertSessionHas('success', 'Usuario actualizado correctamente');
            $response->assertRedirect();
            Mail::assertSent(EstadoEstudianteActualizado::class);
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }


    }

    public function testVerificarUserNotFound()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([]),
                200
            ),
        ]);

        try {
            $response = $this->post('/admin/aceptar/usuario1');
            $response->assertSessionHas('error', 'Usuario no encontrado');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testVerificarApiError()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response([], 500),
        ]);

        try {
            $response = $this->post('/admin/aceptar/usuario1');
            $response->assertSessionHas('error', 'Error al obtener los datos de los usuarios');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testVerificarApiErrorUpdate()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['correoElectronico' => 'usuario1'],
                ]),
                200
            ),
            'http://localhost:3000/actualizar-usuario' => Http::response([], 500),
        ]);

        try {
            $response = $this->post('/admin/aceptar/usuario1');
            $response->assertSessionHas('error', 'Error al aceptar el usuario');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }
    //////////////////////////index2
    public function testIndex2Success()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response(
                json_encode([
                    ['estado' => 'Verificado', 'usuario' => 'usuario1'],
                ]),
                200
            ),
        ]);

        try {
            $response = $this->get('/admin2');
            $response->assertStatus(200);
            $response->assertViewIs('admin.index2');
            $response->assertViewHas('usuarios');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function testIndex2ApiError()
    {
        Http::fake([
            'http://localhost:3000/Usuarios' => Http::response([], 500),
        ]);

        try {
            $response = $this->get('/admin2');
            $response->assertSessionHas('error', 'Error al obtener los usuarios');
            $response->assertRedirect();
        } catch (\Exception $e) {
            $this->fail('No se esperaba una excepción');
        }
    }
 
//////////////////////////////////index3
public function testIndex3Success()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([
                ['estado' => 'Vinculacion', 'usuario' => 'usuario1'],
            ]),
            200
        ),
    ]);

    try {
        $response = $this->get('/admin3');
        $response->assertStatus(200);
        $response->assertViewIs('admin.index3');
        $response->assertViewHas('usuarios');
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testIndex3ApiError()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response([], 500),
    ]);

    try {
        $response = $this->get('/admin3');
        $response->assertSessionHas('error', 'Error al obtener los usuarios');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

//////////////////////////////////eliminar2
public function testEliminar2Success()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([
                ['correoElectronico' => 'usuario1'],
            ]),
            200
        ),
        'http://localhost:3000/actualizar-estado' => Http::response([], 200),
    ]);

    Mail::fake();

    try {
        $response = $this->get('/eliminar2/usuario1@example.com');
        $response->assertSessionHas('success', 'Usuario aceptado correctamente');
        $response->assertRedirect();
        Mail::assertSent(verificacion::class);
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testEliminar2UserNotFound()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([]),
            200
        ),
    ]);

    try {
        $response = $this->get('/eliminar2/usuario2@example.com');
        $response->assertSessionHas('error', 'Usuario no encontrado');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testEliminar2ApiError()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response([], 500),
    ]);

    try {
        $response = $this->get('/eliminar2/usuario1@example.com');
        $response->assertSessionHas('error', 'Error al obtener los datos de los usuarios');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testEliminar2ApiErrorUpdate()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([
                ['correoElectronico' => 'usuario1'],
            ]),
            200
        ),
        'http://localhost:3000/actualizar-estado' => Http::response([], 500),
    ]);

    try {
        $response = $this->get('/eliminar2/usuario1@example.com');
        $response->assertSessionHas('error', 'Error al aceptar el usuario');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

//////////////////////////////////descargar
public function testDescargarSuccess()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([
                ['correoElectronico' => 'usuario1'],
            ]),
            200
        ),
        'http://localhost:3000/descargar-usuario' => Http::response([], 200),
    ]);

    try {
        $response = $this->get('/admin/descargar/usuario1');
        $response->assertSessionHas('success', 'Usuario descargado correctamente');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }

}

public function testDescargarUserNotFound()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([]),
            200
        ),
    ]);

    try {
        $response = $this->get('/admin/descargar/usuario1');
        $response->assertSessionHas('error', 'Usuario no encontrado');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testDescargarApiError()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response([], 500),
    ]);

    try {
        $response = $this->get('/admin/descargar/usuario1');
        $response->assertSessionHas('error', 'Error al obtener los datos de los usuarios');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}

public function testDescargarApiErrorDelete()
{
    Http::fake([
        'http://localhost:3000/Usuarios' => Http::response(
            json_encode([
                ['correoElectronico' => 'usuario1'],
            ]),
            200
        ),
        'http://localhost:3000/descargar-usuario' => Http::response([], 500),
    ]);

    try {
        $response = $this->get('/admin/descargar/usuario1');
        $response->assertSessionHas('error', 'Error al descargar el usuario');
        $response->assertRedirect();
    } catch (\Exception $e) {
        $this->assertInstanceOf(\Exception::class, $e);
    }
}



    





}

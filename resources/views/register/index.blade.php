<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Estudiante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<style>
.bg-animation {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset("img/Espe-Sede-Santo-Domingo.jpg") }}');
    animation: bgAnimation 30s linear infinite;
    z-index: -1;
    opacity: 0.4; 
}


.bg-darken {
    background-color: rgba(0, 0, 0, 0.5); 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2; 
}


        </style>
<body>

<div class="bg-animation"></div>
<div class="bg-darken"></div>
    <div class="container contact-form">
        <div class="contact-image">
            <img src="{{ asset('img/logoEspe.png') }}" alt="rocket_contact"/>
        </div>
             <h4 class="text-center">Postulación Estudiantes - Vinculación con la Sociedad</h4>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <form id="formulario" action="{{ route('register.create') }}" method="post" class="col-md-8 mx-auto">
                        @csrf
                        <div class="form-group">
                            <label for="nombreCompleto">Nombre Completo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">person</i></span>
                                </div>
                                <input type="text" id="nombreCompleto" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras y espacios" name="nombreCompleto" required>
                            </div>
                            <span id="errorNombreCompleto" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">credit_card</i></span>
                                </div>
                                <input type="text" id="cedula" class="form-control" pattern="[0-9]{10}" maxlength="10" title="Ingrese una cédula válida (10 dígitos)" name="cedula" required>
                            </div>
                            <span id="errorCedula" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="correoElectronico">Correo Electrónico:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">email</i></span>
                                </div>
                                <input type="email" id="correoElectronico" class="form-control" name="correoElectronico"   title="Ingrese un correo electrónico válido" required>
                            </div>
                            <span id="errorCorreoElectronico" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">location_city</i></span>
                                </div>
                                <input type="text" id="ciudad" class="form-control" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" name="ciudad" required>
                            </div>
                            <span id="errorCiudad" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cohorte">Cohorte:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">event</i></span>
                                </div>
                                <select id="cohorte" class="form-control" required name="cohorte">
                                    <option value="" disabled selected>Selecciona una cohorte</option>
                                    <option value="Cohorte1">201710</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="periodo">Periodo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                </div>
                                <select id="periodo" class="form-control" name="periodo" required>
                                    <option value="" disabled selected>Selecciona un período</option>
                                    <option value="Periodo1">Período 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="carrera">Carrera:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="material-icons">school</i></span>
                                </div>
                                <select id="carrera" class="form-control" name="carrera" required>
                                    <option value="" disabled selected>Selecciona la Carrera</option>
                                    <option value="ITIN">ITIN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="g-recaptcha text-center" data-sitekey="6LefKzMpAAAAAE4DwDZtfi1xPA--wIAizzSfcFVX" required></div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success w-50">
                        <i class="material-icons">send</i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">

            <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>

    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/register.js') }}"></script>
    <script>
        @if (session('success'))
            swal("¡Registro exitoso!", "{{ session('success') }}", "success");
        @elseif(session('error'))
        swal("¡Error!", "{{ session('error') }}", "error");
        @endif

         

    </script>



</body>

</html>
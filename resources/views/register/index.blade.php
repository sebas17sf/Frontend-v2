<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Estudiante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>






<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="https://srvcas.espe.edu.ec/authenticationendpoint/images/Logo-MiESPE.png" alt="Logo ESPE"
                class="logo-image">
        </div>

        <div class="sidebar-links">

            <a href="{{ route('login.index') }}" class="logout-btn">
                <i class="material-icons">exit_to_app</i> Salir
            </a>
        </div>
    </div>

    <div class="content">
        <main class="container">
            <h4 class="mb-4 text-center">Postulacion Estudiantes Vinculacion con la sociedad</h4>

            <form id="formulario" action="{{ route('register.create') }}" method="post" class="col-md-8 mx-auto">
                @csrf
                <div class="form-group">
                    <label for="nombreCompleto">Nombre Completo:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">person</i></span>
                        </div>
                        <input type="text" id="nombreCompleto" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                            title="Solo se permiten letras y espacios" name="nombreCompleto">
                    </div>
                    <span id="errorNombreCompleto" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">credit_card</i></span>
                        </div>
                        <input type="text" id="cedula" class="form-control" pattern="[0-9]{10}" maxlength="10"
                            title="Ingrese una cédula válida (10 dígitos)" name="cedula">
                    </div>
                    <span id="errorCedula" class="text-danger"></span>
                </div>


                <div class="form-group">
                    <label for="correoElectronico">Correo Electrónico:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">email</i></span>
                        </div>
                        <input type="email" id="correoElectronico" class="form-control" name="correoElectronico"
                            pattern="[A-Za-z0-9._%+-]+@espe\.edu\.ec"
                            title="Ingrese un correo electrónico válido de la ESPE (ejemplo@espe.edu.ec)" required>
                    </div>
                    <span id="errorCorreoElectronico" class="text-danger"></span>
                </div>




                <div class="form-group">
                    <label for="ciudad">Ciudad:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">location_city</i></span>
                        </div>
                        <input type="text" id="ciudad" class="form-control" pattern="[A-Za-z\s]+"
                            title="Solo se permiten letras y espacios" name="ciudad" required>
                    </div>
                    <span id="errorCiudad" class="text-danger"></span>
                </div>


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

                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LeUvGYpAAAAABsVz5R8qpy44u3a32CbdizKIKXr" required></div>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="material-icons">send</i> Enviar
                    </button>
                </div>


            </form>
        </main>
    </div>

    <footer class="footer">
        <div class="container">
            <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>
        </div>
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
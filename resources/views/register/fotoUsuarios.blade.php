<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <div class="container">
        <header class="sidebar">
            <div class="logo-container">
                <hr>
                <img src="https://srvcas.espe.edu.ec/authenticationendpoint/images/Logo-MiESPE.png" alt="Logo ESPE"
                    class="logo-image">
            </div>
            <hr>
            <div class="sidebar-links">
                <a href="{{ route('login.index') }}" class="logout-btn">
                    <i class="material-icons">exit_to_app</i> Salir
                </a>
            </div>
        </header>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <div class="container-fluid">
                    <h4 class="h3 mb-2 text-gray-800 text-center"><b>Estudiantes Vinculacion con la Sociedad-
                            Envio de comprobante</b></h4>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Subir comprobante de matricula</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register.createFoto', ['correoElectronico' => $correoElectronico]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="correoElectronico" value="{{ $correoElectronico }}">
                            
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Subir su matrícula de estudiante (Solo imágenes)</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto" accept="image/*" required>
                                    <small id="fileHelp" class="form-text text-muted">Solo se permiten archivos de imagen.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <footer class="footer">
        <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('form').submit(function (event) {
                var fileInput = $('#exampleFormControlFile1');
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    
                if (!allowedExtensions.exec(fileInput.val())) {
                    event.preventDefault(); 
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Solo se permiten archivos de imagen.',
                    });
                }
            });
        });
    </script>
    
</body>

</html>

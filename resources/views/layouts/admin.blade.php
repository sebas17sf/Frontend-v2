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
</head>

<body>
    <div class="container">
        <hr>
        <!-- Header -->
        <header class="sidebar">
            <div class="logo-container">
                <hr>
                <img src="https://srvcas.espe.edu.ec/authenticationendpoint/images/Logo-MiESPE.png" alt="Logo ESPE"
                    class="logo-image">
            </div>
            <hr>
            <div class="sidebar-links">
               

                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="material-icons">assignment</i> Aceptacion
                </a>

                <a href="{{ route('admin.index2') }}" class="nav-link">
                    <i class="material-icons">description</i> Control
                </a>

                <a href="/estudiantes-culminados" class="nav-link">
                    <i class="material-icons">work</i> Estudiantes-Culminados
                </a>

                <a href="/login" class="logout-btn">
                    <i class="material-icons">exit_to_app</i> Cerrar Sesión
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main>
             @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>
            </div>
        </footer>
    </div>

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

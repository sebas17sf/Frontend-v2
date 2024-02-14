<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register Panel</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            background-image: url('{{ asset('img/Espe-Sede-Santo-Domingo.jpg') }}');
            animation: bgAnimation 30s linear infinite;
            opacity: 0.5;
            /* Ajusta la opacidad según sea necesario */
            background-color: rgb(89, 94, 95);
            /* Color semi-transparente oscuro */

        }
    </style>
</head>

<body>
    @if (session('success'))
        <script>
            swal("¡Éxito!", "{{ session('success') }}", "success");
        </script>
    @endif

    @if (session('error'))
        <script>
            swal("¡Error!", "{{ session('error') }}", "error");
        </script>
    @endif
    <div class="bg-animation"></div>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <img src="{{ asset('img/logoEspeEscudo.png') }}" alt="Login Image" class="card-img-top rounded login-image"
                style="max-width: 100px;">
            <div class="info-content">

                <h2>Deseas iniciar sesion?</h2>
                <p>Ingresa como administrador</p>
                <label id="label-register" for="log-reg-show">Login</label>
                <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
            </div>
        </div>

        <div class="register-info-box">
            <img src="{{ asset('img/logoEspeEscudo.png') }}" alt="Login Image" class="card-img-top rounded login-image"
                style="max-width: 100px;">
            <div class="info-content">
                <h2>Deseas Postularte?</h2>
                <p>Haz clic en el botón para llenar el formulario.</p>
                <label id="label-login" for="log-login-show">Formulario</label>
                <input type="radio" name="active-log-panel" id="log-login-show">
            </div>
        </div>


        <div class="white-panel">
            <div class="login-show">
                <h4 class="card-title text-center">VINCULACIÓN CON LA SOCIEDAD</h4>
                <hr>
                <h2 class="text-center">Iniciar Sesion</h2>
                <form action="{{ route('login.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Usuario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Clave" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                </form>

            </div>
            <div class="register-show">
                <h4 class="card-title text-center">VINCULACIÓN CON LA SOCIEDAD</h4>
                <hr>
                <h2 class="text-center">Registro </h2>
                <br>
                <a href="{{ route('register.index') }}" class="btn btn-primary btn-block">Formulario</a>

            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });

        $('.login-reg-panel input[type="radio"]').on('change', function() {
            if ($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut();
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');
            } else if ($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
    <script>
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                event.preventDefault();
                swal("¡Error!", "Por favor, completa el reCAPTCHA.", "error");
            }
        }); <
        /body> <
        /html>

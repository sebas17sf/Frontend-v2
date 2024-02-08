<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style>
    .login-container {
        height: 100vh;
        display: flex;
    }

    .left-side {
        flex: 7;
        overflow: hidden;
    }

    .login-image {
        width: 100%;
        max-width: 250px;
        height: auto;
        display: block;
        margin: auto;
    }

    .right-side {
        flex: 3;
        box-sizing: border-box;
    }

    .background-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
    }

    h2.card-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }

        .left-side,
        .right-side {
            flex: 1;
        }

        .login-image {
            max-width: 100%;
        }
    }
</style>

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




    <div class="login-container d-flex">
        <div class="left-side">
            <img src="{{ asset('img/Espe-Sede-Santo-Domingo.jpg') }}" alt="Background Image" class="background-image">
        </div>
        <div class="right-side">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="card-title">VINCULACIÓN CON LA SOCIEDAD</h2>
                    <br>
                    <img src="{{ asset('img/logoEspeEscudo.png') }}" alt="Login Image"
                        class="card-img-top rounded login-image">
                    <br>
                    <ul class="nav nav-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#loginForm" role="tab"
                                aria-controls="loginForm" aria-selected="true">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#registerForm" role="tab"
                                aria-controls="registerForm" aria-selected="false">Postulacion</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="loginForm" role="tabpanel"
                            aria-labelledby="login-tab">
                            <h2 class="card-title">Iniciar Sesión</h2>
                            <form action="{{ route('login.login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Usuario" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Clave" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="registerForm" role="tabpanel" aria-labelledby="register-tab">
                            <h2 class="card-title">Postulacion</h2>
                            <a href="{{ route('register.index') }}" class="btn btn-primary btn-block">Formulario</a>

                        </div>

                    </div>

                    <br>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('registration-form').addEventListener('submit', function (event) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                event.preventDefault();
                swal("¡Error!", "Por favor, completa el reCAPTCHA.", "error");
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
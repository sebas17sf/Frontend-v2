 

document.getElementById('nombreCompleto').addEventListener('input', function () {
    var nombreCompletoInput = this;

    var errorNombreCompleto = document.getElementById('errorNombreCompleto');

    if (!nombreCompletoInput.checkValidity()) {
        errorNombreCompleto.textContent = 'Solo se permiten letras y espacios';
    } else {
        errorNombreCompleto.textContent = '';
    }
});


document.getElementById('cedula').addEventListener('input', function () {
    var cedulaInput = this;
    var errorCedula = document.getElementById('errorCedula');

    if (!validarCedulaEcuatoriana(cedulaInput.value)) {
        errorCedula.textContent = 'Ingrese una cédula ecuatoriana válida';
    } else {
        errorCedula.textContent = '';
    }
});

function validarCedulaEcuatoriana(cedula) {
    if (!/^[0-9]{10}$/.test(cedula)) {
        return false;
    }

    var digitos = cedula.split('').map(Number);

    var suma = digitos.slice(0, 9).reduce((acc, val, idx) => acc + (idx % 2 === 0 ? (val * 2 > 9 ? val * 2 - 9 : val * 2) : val), 0);
    var digitoVerificadorCalculado = suma % 10 === 0 ? 0 : 10 - (suma % 10);

    return digitos[9] === digitoVerificadorCalculado;
}

document.addEventListener('DOMContentLoaded', function () {
    var correoElectronicoInput = document.getElementById('correoElectronico');
    var errorCorreoElectronico = document.getElementById('errorCorreoElectronico');

    if (correoElectronicoInput && errorCorreoElectronico) {
        correoElectronicoInput.addEventListener('input', function () {
            if (!correoElectronicoInput.checkValidity() || !validarCorreoElectronico(correoElectronicoInput.value)) {
                errorCorreoElectronico.textContent = 'Ingrese un correo electrónico válido';
            } else {
                errorCorreoElectronico.textContent = '';
            }
        });
    }
});

function validarCorreoElectronico(correo) {
     var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$/;

     if (correo !== '@' && regex.test(correo)) {
        return true; // Correo válido
    } else {
        return false; // Correo inválido
    }
}



document.getElementById('ciudad').addEventListener('input', function () {
    var ciudadInput = this;
    var errorCiudad = document.getElementById('errorCiudad');

    if (!ciudadInput.checkValidity()) {
        errorCiudad.textContent = 'Solo se permiten letras y espacios';
    } else {
        errorCiudad.textContent = '';
    }
});
  
document.getElementById('formulario').addEventListener('submit', function (event) {
    var recaptchaResponse = document.getElementById('g-recaptcha-response').value;

    if (!recaptchaResponse) {
        // Si no se ha completado el reCAPTCHA, evita que el formulario se envíe
        event.preventDefault();
        swal("¡Error!", "Por favor, completa la verificación reCAPTCHA.", "error");
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var formulario = document.getElementById('formulario');

    if (formulario) {
        formulario.addEventListener('submit', function(event) {
            var recaptchaResponse = document.getElementById('g-recaptcha-response').value;

            if (!recaptchaResponse) {
                // Si no se ha completado el reCAPTCHA, evita que el formulario se envíe
                event.preventDefault();
                swal("¡Error!", "Por favor, completa la verificación reCAPTCHA.", "error");
            }
        });
    } else {
        console.error("No se encontró el formulario con id 'formulario'");
    }
});
document.getElementById('nombreCompleto').addEventListener('blur', function () {
    var nombreCompletoInput = this;
    var errorNombreCompleto = document.getElementById('errorNombreCompleto');

    if (!nombreCompletoInput.value.trim()) {
        errorNombreCompleto.textContent = 'Campo requerido';
    } else if (!nombreCompletoInput.checkValidity()) {
        errorNombreCompleto.textContent = 'Solo se permiten letras y espacios';
    } else {
        errorNombreCompleto.textContent = '';
    }
});

document.getElementById('cedula').addEventListener('blur', function () {
    var cedulaInput = this;
    var errorCedula = document.getElementById('errorCedula');

    if (!cedulaInput.value.trim()) {
        errorCedula.textContent = 'Campo requerido';
    } else if (!validarCedulaEcuatoriana(cedulaInput.value)) {
        errorCedula.textContent = 'Ingrese una cédula ecuatoriana válida';
    } else {
        errorCedula.textContent = '';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var correoElectronicoInput = document.getElementById('correoElectronico');
    var errorCorreoElectronico = document.getElementById('errorCorreoElectronico');

    if (correoElectronicoInput && errorCorreoElectronico) {
        correoElectronicoInput.addEventListener('blur', function () {
            if (!correoElectronicoInput.value.trim()) {
                errorCorreoElectronico.textContent = 'Campo requerido';
            } else if (!correoElectronicoInput.checkValidity() || !validarCorreoElectronico(correoElectronicoInput.value)) {
                errorCorreoElectronico.textContent = 'Ingrese un correo electrónico válido';
            } else {
                errorCorreoElectronico.textContent = '';
            }
        });
    }
});

document.getElementById('ciudad').addEventListener('blur', function () {
    var ciudadInput = this;
    var errorCiudad = document.getElementById('errorCiudad');

    if (!ciudadInput.value.trim()) {
        errorCiudad.textContent = 'Campo requerido';
    } else if (!ciudadInput.checkValidity()) {
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

    var nombreCompletoInput = document.getElementById('nombreCompleto');
    var cedulaInput = document.getElementById('cedula');
    var correoElectronicoInput = document.getElementById('correoElectronico');
    var ciudadInput = document.getElementById('ciudad');

    var errorNombreCompleto = document.getElementById('errorNombreCompleto');
    var errorCedula = document.getElementById('errorCedula');
    var errorCorreoElectronico = document.getElementById('errorCorreoElectronico');
    var errorCiudad = document.getElementById('errorCiudad');

    // Validación para Nombre Completo
    if (!nombreCompletoInput.value.trim()) {
        errorNombreCompleto.textContent = 'Campo requerido';
        event.preventDefault();
    } else if (!nombreCompletoInput.checkValidity()) {
        errorNombreCompleto.textContent = 'Solo se permiten letras y espacios';
        event.preventDefault();
    } else {
        errorNombreCompleto.textContent = '';
    }

    // Validación para Cédula
    if (!cedulaInput.value.trim()) {
        errorCedula.textContent = 'Campo requerido';
        event.preventDefault();
    } else if (!validarCedulaEcuatoriana(cedulaInput.value)) {
        errorCedula.textContent = 'Ingrese una cédula ecuatoriana válida';
        event.preventDefault();
    } else {
        errorCedula.textContent = '';
    }

    // Validación para Correo Electrónico
    if (!correoElectronicoInput.value.trim()) {
        errorCorreoElectronico.textContent = 'Campo requerido';
        event.preventDefault();
    } else if (!correoElectronicoInput.checkValidity() || !validarCorreoElectronico(correoElectronicoInput.value)) {
        errorCorreoElectronico.textContent = 'Ingrese un correo electrónico válido';
        event.preventDefault();
    } else {
        errorCorreoElectronico.textContent = '';
    }

    // Validación para Ciudad
    if (!ciudadInput.value.trim()) {
        errorCiudad.textContent = 'Campo requerido';
        event.preventDefault();
    } else if (!ciudadInput.checkValidity()) {
        errorCiudad.textContent = 'Solo se permiten letras y espacios';
        event.preventDefault();
    } else {
        errorCiudad.textContent = '';
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

function validarCorreoElectronico(correo) {
    var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$/;

    if (correo !== '@' && regex.test(correo)) {
        return true; // Correo válido
    } else {
        return false; // Correo inválido
    }
}

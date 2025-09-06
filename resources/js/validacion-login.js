// validaciones-login.js
// validaciones-login.js
document.addEventListener('DOMContentLoaded', function () {
    // Precargar usuarios sin duplicar
    const usuariosPrecargados = [
        { correo: "admin@fas.com", contrasena: "admin123", rol: "admin" },
        { correo: "coach@escuela1.com", contrasena: "entreno2024", rol: "entrenador" },
        { correo: "jugador1@fas.com", contrasena: "juga1234", rol: "jugador" },
        { correo: "jugador2@fas.com", contrasena: "golazo2024", rol: "jugador" }
    ];

    let usuariosActuales = JSON.parse(localStorage.getItem("usuarios")) || [];

    usuariosPrecargados.forEach(nuevo => {
        const yaExiste = usuariosActuales.some(u => u.correo === nuevo.correo);
        if (!yaExiste) {
            usuariosActuales.push(nuevo);
        }
    });

    localStorage.setItem("usuarios", JSON.stringify(usuariosActuales));

    const form = document.querySelector('form');
    const emailInput = document.getElementById('usuario');
    const passwordInput = document.getElementById('contrasena');

    function mostrarError(input, mensaje) {
        const errorPrevio = input.parentNode.querySelector('.error-message');
        if (errorPrevio) errorPrevio.remove();

        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-danger mt-1';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.textContent = mensaje;

        input.classList.add('is-invalid');
        input.parentNode.appendChild(errorDiv);
    }

    function limpiarError(input) {
        const errorPrevio = input.parentNode.querySelector('.error-message');
        if (errorPrevio) errorPrevio.remove();
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    function validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.trim()) return 'El correo electrónico es obligatorio';
        if (!emailRegex.test(email)) return 'Por favor ingrese un correo electrónico válido';
        if (email.length > 100) return 'El correo electrónico no puede exceder 100 caracteres';
        return null;
    }

    function validarPassword(password) {
        if (!password) return 'La contraseña es obligatoria';
        if (password.length < 6) return 'La contraseña debe tener al menos 6 caracteres';
        if (password.length > 50) return 'La contraseña no puede exceder 50 caracteres';
        return null;
    }

    emailInput.addEventListener('blur', function () {
        const errorEmail = validarEmail(this.value);
        errorEmail ? mostrarError(this, errorEmail) : limpiarError(this);
    });

    passwordInput.addEventListener('blur', function () {
        const errorPassword = validarPassword(this.value);
        errorPassword ? mostrarError(this, errorPassword) : limpiarError(this);
    });

    emailInput.addEventListener('input', function () {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
            const errorPrevio = this.parentNode.querySelector('.error-message');
            if (errorPrevio) errorPrevio.remove();
        }
    });

    passwordInput.addEventListener('input', function () {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
            const errorPrevio = this.parentNode.querySelector('.error-message');
            if (errorPrevio) errorPrevio.remove();
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const errorEmail = validarEmail(emailInput.value);
        const errorPassword = validarPassword(passwordInput.value);
        let esFormularioValido = true;

        if (errorEmail) {
            mostrarError(emailInput, errorEmail);
            esFormularioValido = false;
        } else {
            limpiarError(emailInput);
        }

        if (errorPassword) {
            mostrarError(passwordInput, errorPassword);
            esFormularioValido = false;
        } else {
            limpiarError(passwordInput);
        }

        if (esFormularioValido) {
            procesarLogin(emailInput.value, passwordInput.value);
        } else {
            const primerError = form.querySelector('.is-invalid');
            if (primerError) {
                primerError.focus();
                primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    function procesarLogin(email, password) {
        const submitBtn = form.querySelector('button[type="submit"]');
        const textoOriginal = submitBtn.textContent;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Ingresando...';

        const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];
        const usuarioEncontrado = usuarios.find(user => user.correo === email);

        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = textoOriginal;

            if (usuarioEncontrado) {
                if (usuarioEncontrado.contrasena === password) {
                    sessionStorage.setItem('usuarioLogeado', JSON.stringify(usuarioEncontrado));

                    if (usuarioEncontrado.rol === "admin") {
                        mostrarMensajeExito('Bienvenido administrador. Redirigiendo...');
                        setTimeout(() => window.location.href = 'Administrador/Dashboard.html', 1500);

                    } else if (usuarioEncontrado.rol === "entrenador") {
                        mostrarMensajeExito('Bienvenido entrenador. Redirigiendo...');
                        setTimeout(() => window.location.href = 'Entrenador/menu-entrenador.html', 1500);

                    } else if (usuarioEncontrado.rol === "jugador") {
                        mostrarMensajeExito('Bienvenido jugador. Redirigiendo...');
                        setTimeout(() => window.location.href = 'Jugador/principal.html', 1500);

                    } else {
                        mostrarErrorLogin('Rol no permitido para el acceso.');
                    }

                } else {
                    mostrarErrorLogin('Contraseña incorrecta. Intente nuevamente.');
                }
            } else {
                mostrarErrorLogin('El correo electrónico no está registrado.');
            }
        }, 2000);
    }

    function mostrarErrorLogin(mensaje) {
        const alertaPrevía = document.querySelector('.alert-login');
        if (alertaPrevía) alertaPrevía.remove();

        const alerta = document.createElement('div');
        alerta.className = 'alert alert-danger alert-dismissible fade show alert-login mt-3';
        alerta.innerHTML = `
            <strong>Error:</strong> ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        const submitBtn = form.querySelector('button[type="submit"]');
        form.insertBefore(alerta, submitBtn.parentNode);
    }

    function mostrarMensajeExito(mensaje) {
        const alertaPrevía = document.querySelector('.alert-login');
        if (alertaPrevía) alertaPrevía.remove();

        const alerta = document.createElement('div');
        alerta.className = 'alert alert-success alert-login mt-3';
        alerta.innerHTML = `<strong>¡Éxito!</strong> ${mensaje}`;

        const submitBtn = form.querySelector('button[type="submit"]');
        form.insertBefore(alerta, submitBtn.parentNode);
    }

    function limpiarFormulario() {
        emailInput.value = '';
        passwordInput.value = '';
        emailInput.classList.remove('is-valid', 'is-invalid');
        passwordInput.classList.remove('is-valid', 'is-invalid');

        const errores = form.querySelectorAll('.error-message');
        errores.forEach(error => error.remove());

        const alertas = form.querySelectorAll('.alert-login');
        alertas.forEach(alerta => alerta.remove());
    }

    window.limpiarFormularioLogin = limpiarFormulario;
});

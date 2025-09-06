// validaciones-registro.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const nombresInput = document.getElementById('nombres');
    const apellidosInput = document.getElementById('apellidos');
    const tipoDocumentoSelect = document.getElementById('tipoDocumento');
    const numeroDocumentoInput = document.getElementById('numeroDocumento');
    const fechaNacimientoInput = document.getElementById('fechaNacimiento');
    const correoInput = document.getElementById('correo');
    const telefonoInput = document.getElementById('telefono');
    const generoSelect = document.getElementById('Genero');
    const passwordInput = document.getElementById('password');

    // Función para mostrar mensajes de error
    function mostrarError(input, mensaje) {
        const errorPrevio = input.parentNode.querySelector('.error-message');
        if (errorPrevio) {
            errorPrevio.remove();
        }

        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-danger mt-1';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.textContent = mensaje;
        
        input.classList.add('is-invalid');
        input.parentNode.appendChild(errorDiv);
    }

    // Función para limpiar errores
    function limpiarError(input) {
        const errorPrevio = input.parentNode.querySelector('.error-message');
        if (errorPrevio) {
            errorPrevio.remove();
        }
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    // Validación de nombres
    function validarNombres(nombres) {
        const nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        
        if (!nombres.trim()) {
            return 'Los nombres son obligatorios';
        }
        
        if (nombres.trim().length < 2) {
            return 'Los nombres deben tener al menos 2 caracteres';
        }
        
        if (nombres.trim().length > 50) {
            return 'Los nombres no pueden exceder 50 caracteres';
        }
        
        if (!nombreRegex.test(nombres.trim())) {
            return 'Los nombres solo pueden contener letras y espacios';
        }
        
        return null;
    }

    // Validación de apellidos
    function validarApellidos(apellidos) {
        const apellidoRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        
        if (!apellidos.trim()) {
            return 'Los apellidos son obligatorios';
        }
        
        if (apellidos.trim().length < 2) {
            return 'Los apellidos deben tener al menos 2 caracteres';
        }
        
        if (apellidos.trim().length > 50) {
            return 'Los apellidos no pueden exceder 50 caracteres';
        }
        
        if (!apellidoRegex.test(apellidos.trim())) {
            return 'Los apellidos solo pueden contener letras y espacios';
        }
        
        return null;
    }

    // Validación de tipo de documento
    function validarTipoDocumento(tipo) {
        if (!tipo) {
            return 'Debe seleccionar un tipo de documento';
        }
        
        const tiposValidos = ['CC', 'TI', 'CE', 'PA'];
        if (!tiposValidos.includes(tipo)) {
            return 'Tipo de documento no válido';
        }
        
        return null;
    }

    // Validación de número de documento
    function validarNumeroDocumento(numero, tipo) {
        if (!numero.trim()) {
            return 'El número de documento es obligatorio';
        }
        
        // Remover espacios y caracteres especiales
        const numeroLimpio = numero.replace(/\D/g, '');
        
        if (!numeroLimpio) {
            return 'El número de documento debe contener solo números';
        }
        
        // Validaciones específicas por tipo de documento
        switch (tipo) {
            case 'CC': // Cédula de Ciudadanía
                if (numeroLimpio.length < 6 || numeroLimpio.length > 10) {
                    return 'La cédula debe tener entre 6 y 10 dígitos';
                }
                break;
            case 'TI': // Tarjeta de Identidad
                if (numeroLimpio.length < 8 || numeroLimpio.length > 11) {
                    return 'La tarjeta de identidad debe tener entre 8 y 11 dígitos';
                }
                break;
            case 'CE': // Cédula de Extranjería
                if (numeroLimpio.length < 6 || numeroLimpio.length > 12) {
                    return 'La cédula de extranjería debe tener entre 6 y 12 dígitos';
                }
                break;
            case 'PA': // Pasaporte
                if (numero.trim().length < 6 || numero.trim().length > 12) {
                    return 'El pasaporte debe tener entre 6 y 12 caracteres';
                }
                break;
        }
        
        return null;
    }

    // Validación de fecha de nacimiento
    function validarFechaNacimiento(fecha) {
        if (!fecha) {
            return 'La fecha de nacimiento es obligatoria';
        }
        
        const fechaNac = new Date(fecha);
        const fechaActual = new Date();
        const fechaMinima = new Date();
        fechaMinima.setFullYear(fechaActual.getFullYear() - 100); // Máximo 100 años
        
        if (fechaNac > fechaActual) {
            return 'La fecha de nacimiento no puede ser futura';
        }
        
        if (fechaNac < fechaMinima) {
            return 'La fecha de nacimiento no puede ser mayor a 100 años';
        }
        
        // Validar edad mínima (13 años para registro)
        const fechaMinEdad = new Date();
        fechaMinEdad.setFullYear(fechaActual.getFullYear() - 13);
        
        if (fechaNac > fechaMinEdad) {
            return 'Debe ser mayor de 13 años para registrarse';
        }
        
        return null;
    }

    // Validación de correo electrónico
    function validarCorreo(correo) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!correo.trim()) {
            return 'El correo electrónico es obligatorio';
        }
        
        if (!emailRegex.test(correo.trim())) {
            return 'Por favor ingrese un correo electrónico válido';
        }
        
        if (correo.trim().length > 100) {
            return 'El correo electrónico no puede exceder 100 caracteres';
        }
        
        return null;
    }

    // Validación de teléfono
    function validarTelefono(telefono) {
        const telefonoRegex = /^[0-9+\-\s()]+$/;
        const numeroLimpio = telefono.replace(/\D/g, '');
        
        if (!telefono.trim()) {
            return 'El teléfono es obligatorio';
        }
        
        if (!telefonoRegex.test(telefono)) {
            return 'El teléfono contiene caracteres no válidos';
        }
        
        if (numeroLimpio.length < 7) {
            return 'El teléfono debe tener al menos 7 dígitos';
        }
        
        if (numeroLimpio.length > 15) {
            return 'El teléfono no puede tener más de 15 dígitos';
        }
        
        // Validación específica para números colombianos (opcional)
        if (numeroLimpio.length === 10 && !numeroLimpio.startsWith('3')) {
            return 'Los números de celular colombianos deben empezar con 3';
        }
        
        return null;
    }

    // Validación de género
    function validarGenero(genero) {
        if (!genero) {
            return 'Debe seleccionar su género';
        }
        
        const generosValidos = ['hombre', 'mujer', 'otro'];
        if (!generosValidos.includes(genero)) {
            return 'Género no válido';
        }
        
        return null;
    }

    // Formatear número de documento mientras se escribe
    numeroDocumentoInput.addEventListener('input', function() {
        // Solo permitir números para CC, TI, CE
        const tipoDoc = tipoDocumentoSelect.value;
        if (['CC', 'TI', 'CE'].includes(tipoDoc)) {
            this.value = this.value.replace(/\D/g, '');
        }
    });

    // Formatear teléfono mientras se escribe
    telefonoInput.addEventListener('input', function() {
        // Remover caracteres no válidos excepto números, +, -, espacios, paréntesis
        this.value = this.value.replace(/[^0-9+\-\s()]/g, '');
    });

    // Capitalizar nombres y apellidos
    function capitalizarTexto(input) {
        input.addEventListener('blur', function() {
            const palabras = this.value.toLowerCase().split(' ');
            const palabrasCapitalizadas = palabras.map(palabra => 
                palabra.charAt(0).toUpperCase() + palabra.slice(1)
            );
            this.value = palabrasCapitalizadas.join(' ');
        });
    }

    capitalizarTexto(nombresInput);
    capitalizarTexto(apellidosInput);

    // Validaciones en tiempo real (onBlur)
    nombresInput.addEventListener('blur', function() {
        const error = validarNombres(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    apellidosInput.addEventListener('blur', function() {
        const error = validarApellidos(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    tipoDocumentoSelect.addEventListener('change', function() {
        const error = validarTipoDocumento(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
        
        // Revalidar número de documento si ya hay uno ingresado
        if (numeroDocumentoInput.value) {
            const errorNumero = validarNumeroDocumento(numeroDocumentoInput.value, this.value);
            errorNumero ? mostrarError(numeroDocumentoInput, errorNumero) : limpiarError(numeroDocumentoInput);
        }
    });

    numeroDocumentoInput.addEventListener('blur', function() {
        const error = validarNumeroDocumento(this.value, tipoDocumentoSelect.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    fechaNacimientoInput.addEventListener('blur', function() {
        const error = validarFechaNacimiento(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    correoInput.addEventListener('blur', function() {
        const error = validarCorreo(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    telefonoInput.addEventListener('blur', function() {
        const error = validarTelefono(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    generoSelect.addEventListener('change', function() {
        const error = validarGenero(this.value);
        error ? mostrarError(this, error) : limpiarError(this);
    });

    // Limpiar errores cuando el usuario empiece a escribir
    const inputs = [nombresInput, apellidosInput, numeroDocumentoInput, correoInput, telefonoInput];
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const errorPrevio = this.parentNode.querySelector('.error-message');
                if (errorPrevio) errorPrevio.remove();
            }
        });
    });

    // Validación al enviar el formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar todos los campos
        const errores = {
            nombres: validarNombres(nombresInput.value),
            apellidos: validarApellidos(apellidosInput.value),
            tipoDocumento: validarTipoDocumento(tipoDocumentoSelect.value),
            numeroDocumento: validarNumeroDocumento(numeroDocumentoInput.value, tipoDocumentoSelect.value),
            fechaNacimiento: validarFechaNacimiento(fechaNacimientoInput.value),
            correo: validarCorreo(correoInput.value),
            telefono: validarTelefono(telefonoInput.value),
            genero: validarGenero(generoSelect.value),
            contrasena: validarPassword(passwordInput.value)
        };
        
        let esFormularioValido = true;
        
        // Mostrar errores
        Object.keys(errores).forEach(campo => {
            const input = document.getElementById(campo === 'tipoDocumento' ? 'tipoDocumento' : 
                          campo === 'numeroDocumento' ? 'numeroDocumento' :
                          campo === 'fechaNacimiento' ? 'fechaNacimiento' :
                          campo === 'contrasena' ? 'password' :
                          campo === 'genero' ? 'Genero' : campo);
                          
            
            if (errores[campo]) {
                mostrarError(input, errores[campo]);
                esFormularioValido = false;
            } else {
                limpiarError(input);
            }
        });
        
        // Validación adicional: verificar si el correo ya existe (simulado)
        if (esFormularioValido) {
            verificarCorreoExistente(correoInput.value).then(existe => {
                if (existe) {
                    mostrarError(correoInput, 'Este correo electrónico ya está registrado');
                    esFormularioValido = false;
                }
                
                if (esFormularioValido) {
                    procesarRegistro();
                } else {
                    scrollAlPrimerError();
                }
            });
        } else {
            scrollAlPrimerError();
        }
    });

    // Función para hacer scroll al primer error
    function scrollAlPrimerError() {
        const primerError = form.querySelector('.is-invalid');
        if (primerError) {
            primerError.focus();
            primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Función para verificar si el correo ya existe (simulada)
    function verificarCorreoExistente(correo) {
        return new Promise((resolve) => {
            // Simular llamada a API
            setTimeout(() => {
                // Simular que algunos correos ya existen
                const correosExistentes = ['test@example.com', 'admin@fas.com', 'usuario@gmail.com'];
                resolve(correosExistentes.includes(correo.toLowerCase()));
            }, 500);
        });
    }

function validarPassword(password) {
  if (!password) return 'La contraseña es obligatoria';
  if (password.length < 6) return 'La contraseña debe tener al menos 6 caracteres';
  if (password.length > 50) return 'La contraseña no puede exceder 50 caracteres';
  if (!/[a-zA-Z]/.test(password)) return 'Debe contener al menos una letra';
  if (!/\d/.test(password)) return 'Debe contener al menos un número';
  return null;
}

    // Función para procesar el registro
    function procesarRegistro() {
  const submitBtn = form.querySelector('button[type="submit"]');
  const textoOriginal = submitBtn.textContent;

  submitBtn.disabled = true;
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Registrando...';

  const datosRegistro = {
    nombres: nombresInput.value.trim(),
    apellidos: apellidosInput.value.trim(),
    tipoDocumento: tipoDocumentoSelect.value,
    numeroDocumento: numeroDocumentoInput.value.trim(),
    fechaNacimiento: fechaNacimientoInput.value,
    correo: correoInput.value.trim().toLowerCase(),
    telefono: telefonoInput.value.trim(),
    genero: generoSelect.value,
    contrasena: passwordInput.value.trim(), // provisional, puedes cambiarlo luego
    rol: "admin"
  };

  const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];

  const adminExiste = usuarios.some(u => u.rol === "admin");
  
  usuarios.push(datosRegistro);
  localStorage.setItem("usuarios", JSON.stringify(usuarios));
  mostrarMensajeExito("¡Registro exitoso! Redirigiendo al inicio de sesión...");
  
  setTimeout(() => {
    window.location.href = "IncioSesion.html";
  }, 2000);
}


    // Función para mostrar errores de registro
    function mostrarErrorRegistro(mensaje) {
        const alertaPrevía = document.querySelector('.alert-registro');
        if (alertaPrevía) alertaPrevía.remove();

        const alerta = document.createElement('div');
        alerta.className = 'alert alert-danger alert-dismissible fade show alert-registro mt-3';
        alerta.innerHTML = `
            <strong>Error:</strong> ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const submitBtn = form.querySelector('button[type="submit"]');
        form.insertBefore(alerta, submitBtn.parentNode);
    }

    // Función para mostrar mensaje de éxito
    function mostrarMensajeExito(mensaje) {
        const alertaPrevía = document.querySelector('.alert-registro');
        if (alertaPrevía) alertaPrevía.remove();

        const alerta = document.createElement('div');
        alerta.className = 'alert alert-success alert-registro mt-3';
        alerta.innerHTML = `<strong>¡Éxito!</strong> ${mensaje}`;
        
        const submitBtn = form.querySelector('button[type="submit"]');
        form.insertBefore(alerta, submitBtn.parentNode);
    }

    // Función para limpiar todo el formulario
    function limpiarFormulario() {
        form.reset();
        const todosLosInputs = form.querySelectorAll('input, select');
        todosLosInputs.forEach(input => {
            input.classList.remove('is-valid', 'is-invalid');
        });
        
        const errores = form.querySelectorAll('.error-message');
        errores.forEach(error => error.remove());
        
        const alertas = document.querySelectorAll('.alert-registro');
        alertas.forEach(alerta => alerta.remove());
    }

    // Exponer función para limpiar (opcional)
    window.limpiarFormularioRegistro = limpiarFormulario;
});
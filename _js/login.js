$(function () {
    const opcPag = $('#opc_pag').val();

    const showAlert = (title, text, icon, callback) => {
        Swal.fire({ title, text, icon }).then(callback);
    };

    const handleLoginResponse = (data_preg, usuario) => {
        
        const [status, message] = data_preg.split("=");
        
        switch (status) {
            case '0':
                showAlert('¡Bienvenido!', '', 'success', () => window.open('/home/index', '_parent'));
                break;
            case '1':
                showAlert('¡Atención!', '', 'warning', () => window.open(`/login/cambiar?idreg=${usuario}`, '_parent'));
                break;
            case '2':
                showAlert('¡Atención!', 'Usuario y/o Contraseña incorrectos', 'info');
                break;
            case '3':
                showAlert('¡Atención!', 'El Usuario se encuentra Suspendido', 'info');
                break;
            case '4':
                showAlert('¡Oops...!', 'Usuario no Existe', 'error');
                break;
            case '5': // NUEVO: Redirigir a verificación 2FA
                showAlert('Verificación requerida', 'Se requiere autenticación en dos pasos', 'info', () => window.open(`/login/verify_2fa?id=${message}`, '_parent'));
                break;                
            case '6': 
                showAlert('Oops...', 'No supero la validación de seguridad', 'warning', () => $('#usuario').focus());
                break; 
            default:
                 showAlert('Oops...', 'No se pudo enviar el código de verificación. Contacte al administrador.', 'warning', () => $('#usuario').focus());
                break;               
        };
               
    };

    const handleRecoverPasswordResponse = (data_preg) => {
        const messages = {
            '1': { title: 'Confirmación de Envio', text: 'El Email fue enviado satisfactoriamente', icon: 'success', action: () => window.open('/', '_parent') },
            '2': { title: 'Error', text: 'Error al enviar el Email!', icon: 'error' },
            '3': { title: 'Error', text: 'Email Invalido!', icon: 'error' },
            '4': { title: 'Error', text: 'Email Invalido!', icon: 'error' }
        };

        const messageConfig = messages[data_preg] || { title: 'Error', text: 'Respuesta inesperada del servidor', icon: 'error' };
        showAlert(messageConfig.title, messageConfig.text, messageConfig.icon, messageConfig.action);
    };

    const validatePasswordForm = (formId, passwordField, confirmPasswordField, policyCheckbox = null) => {
        let ban = 0;
        let texto = '';

        if ($(passwordField).val() === "") {
            $(passwordField).addClass("brc-danger");
            texto += "* La Contraseña es obligatoria!\n";
            ban = 1;
        }
        if ($(confirmPasswordField).val() === "") {
            $(confirmPasswordField).addClass("brc-danger");
            texto += "* Confirmar Contraseña es obligatorio!\n";
            ban = 1;
        }
        if ($(passwordField).val() !== $(confirmPasswordField).val()) {
            $(confirmPasswordField).addClass("brc-danger");
            texto += "* Las Contraseñas no coinciden!\n";
            ban = 1;
        }
        if (policyCheckbox && !$(policyCheckbox).prop('checked')) {
            $(policyCheckbox).addClass("brc-danger");
            texto += "* Debe Confirmar que Autoriza!\n";
            ban = 1;
        }

        if (ban === 1) {
            Swal.fire("¡Atención!", texto, "warning");
            return false;
        }
        return true;
    };

    const handleFormSubmit = (formId, url, successMessage) => {
        Swal.fire({ title: "Por favor espere!", text: "Procesando la información.", showConfirmButton: false });
        const datos_form = $(formId).serialize();

        $.post(url, datos_form, function (data_form) {
            Swal.close();
            if (data_form === "1") {
                showAlert("¡Correcto!", successMessage, "success", () => {
                    $(formId)[0].reset();
                    window.open('/', '_parent');
                });
            } else {
                Swal.fire("¡Error!", data_form, "error");
            }
        });
        return false;
    };

    if (opcPag === "ingreso") {
        $('#btn_ingresar').click(async function (event) {
            event.preventDefault();

            const recaptchaInput = document.getElementById('g-recaptcha-response');
            
            const usuario = $('#usuario').val();
            
            try {
               // Generar token de reCAPTCHA
                await grecaptcha.ready(async () => {
                    const token = await grecaptcha.execute(
                        RECAPTCHA_SITE_KEY, // Usar la clave dinámica
                        { action: 'login' } // Acción personalizada
                    );
                    
                    // Asignar token al campo oculto
                    recaptchaInput.value = token;
                    // alert(token);
                    // Mostrar loading
                    const originalText = $('#btn_ingresar').html();
                    $('#btn_ingresar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Verificando...');
                    
                    // Enviar el formulario después de obtener el token
                    $.post('/login/verificar', {
                        recaptchaToken: token, 
                        usuario: usuario, 
                        contrasena: $("#contrasena").val() 
                    }, function (data_preg) {
                        $('#btn_ingresar').prop('disabled', false).html(originalText);
                        
                        handleLoginResponse(data_preg, usuario);
                    }).fail(function() {
                        $('#btn_ingresar').prop('disabled', false).html(originalText);
                        Swal.fire({
                            title: 'Error de conexión',
                            text: 'No se pudo conectar con el servidor',
                            icon: 'error'
                        });
                    });
                });
                
            } catch (error) {
                $('#btn_ingresar').prop('disabled', false).html('Ingresar');
                Swal.fire("¡Error!", "Error en la validación de seguridad", "error");                
            }           
        });

        $('#btn_recuperar_pass').click(function (e) {
            e.preventDefault();
            $.post("/login/recuperar_password", { email: $('#id-recover-email').val() }, function (data_preg) {
                handleRecoverPasswordResponse(data_preg);
            });
        });

    } else if (opcPag === "recuperar") {
        $('#btn_guardar').click(function (e) {
            e.preventDefault();
            if (validatePasswordForm("#ResetPassform", '#password', '#confirmar_password')) {
                handleFormSubmit("#ResetPassform", "/login/guardar_nuevaClave", "Registro ingresado correctamente!");
            }
        });
    } else if (opcPag === "cambiar") {
        $('#btn_actualizar').click(function (e) {
            e.preventDefault();
            if (validatePasswordForm("#cambioPassform", '#password', '#confirmar_password', '#poli_protdatos')) {
                handleFormSubmit("#cambioPassform", "/login/actualizar_clave", "Registro ingresado correctamente!");
            }
        });
    }

    $(document).on("keyup", function (event) {
        $("#mensaje").html('');
    });
});
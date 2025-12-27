<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación en Dos Pasos | SIGCA</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="./plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(#6baace, #264783);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: none;
        }
        
        .logo {
            max-width: 200px;
            margin: 0 auto 20px;
        }
        
        .code-input {
            letter-spacing: 10px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            height: 60px;
        }
        
        .timer {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .resend-link {
            cursor: pointer;
            color: #007bff;
        }
        
        .resend-link:hover {
            text-decoration: underline;
        }
        
        .loading {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <img src="<?= base_url('assets/image/SIGCA.png'); ?>" alt="SIGCA" class="logo">
                            <h4 class="mt-3 text-dark">Verificación en Dos Pasos</h4>
                            <p class="text-muted mb-0">Ingresa el código de 6 dígitos enviado a tu email</p>
                        </div>
                        
                        <form id="verify2faForm">
                            <input type="hidden" id="user_id" value="<?= $user_id ?>">
                            
                            <div class="form-group">
                                <label for="code" class="font-weight-bold">Código de verificación</label>
                                <input type="text" 
                                       class="form-control form-control-lg text-center code-input" 
                                       id="code" 
                                       name="code" 
                                       maxlength="6" 
                                       autocomplete="off"
                                       placeholder="000000"
                                       required
                                       autofocus>
                                <small class="form-text text-muted">
                                    Ingresa el código de 6 dígitos que recibiste por email
                                </small>
                            </div>
                            
                            <div class="form-group text-center">
                                <div class="timer mb-2">
                                    El código expira en: <span id="countdown">05:00</span>
                                </div>
                                <a id="resendCode" class="resend-link">
                                    <i class="fas fa-redo"></i> Reenviar código
                                </a>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" id="verifyBtn">
                                    <i class="fas fa-check-circle mr-2"></i> Verificar y continuar
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <a href="<?= base_url('login') ?>" class="btn btn-link text-muted">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver al login
                                </a>
                            </div>
                        </form>
                        
                        <!-- Loading spinner -->
                        <div id="loading" class="loading text-center mt-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                            <p class="mt-2">Verificando...</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center text-white mt-4">
                    <p class="mb-0">© 2020-<?= date('Y') ?> SIGCA - Sistema Integral de Gestión de Calidad</p>
                    <small>Autenticación de dos factores</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            let timeLeft = 300; // 5 minutos en segundos
            let timerInterval;
            
            // Formatear tiempo
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }
            
            // Actualizar contador
            function updateTimer() {
                $('#countdown').text(formatTime(timeLeft));
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    $('#countdown').text('Expirado');
                    $('#code').prop('disabled', true);
                    $('#verifyBtn').prop('disabled', true);
                    
                    Swal.fire({
                        title: 'Código expirado',
                        text: 'El código ha expirado. Por favor solicita uno nuevo.',
                        icon: 'warning',
                        confirmButtonText: 'Reenviar código'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            resendCode();
                        }
                    });
                }
                timeLeft--;
            }
            
            // Iniciar contador
            timerInterval = setInterval(updateTimer, 1000);
            
            // Auto-focus y auto-tab
            $('#code').on('input', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
                
                if ($(this).val().length === 6) {
                    $('#verifyBtn').focus();
                }
            });
            
            // Validar formulario
            $('#verify2faForm').submit(function(e) {
                e.preventDefault();
                
                const code = $('#code').val().trim();
                const userId = $('#user_id').val();
                
                // Validar código
                if (code.length !== 6 || !/^\d+$/.test(code)) {
                    Swal.fire({
                        title: 'Código inválido',
                        text: 'Por favor ingresa un código de 6 dígitos numéricos',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                    $('#code').val('').focus();
                    return;
                }
                
                // Mostrar loading
                $('#loading').show();
                $('#verifyBtn').prop('disabled', true);
                $('#verify2faForm').hide();
                
                // Enviar petición
                $.ajax({
                    url: '<?= base_url("login/validate_2fa") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user_id: userId,
                        code: code
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: '¡Verificación exitosa!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = '<?= base_url("home/index") ?>';
                            });
                        } else {
                            $('#loading').hide();
                            $('#verify2faForm').show();
                            $('#verifyBtn').prop('disabled', false);
                            
                            Swal.fire({
                                title: 'Error de verificación',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Intentar nuevamente'
                            });
                            $('#code').val('').focus();
                        }
                    },
                    error: function() {
                        $('#loading').hide();
                        $('#verify2faForm').show();
                        $('#verifyBtn').prop('disabled', false);
                        
                        Swal.fire({
                            title: 'Error de conexión',
                            text: 'No se pudo conectar con el servidor',
                            icon: 'error',
                            confirmButtonText: 'Reintentar'
                        });
                    }
                });
            });
            
            // Reenviar código
            function resendCode() {
                const userId = $('#user_id').val();
                
                Swal.fire({
                    title: 'Reenviando código',
                    text: 'Por favor espera...',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                
                $.ajax({
                    url: '<?= base_url("login/resend_2fa_code") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        Swal.close();
                        
                        if (response.success) {
                            // Reiniciar timer
                            clearInterval(timerInterval);
                            timeLeft = 300;
                            timerInterval = setInterval(updateTimer, 1000);
                            
                            // Habilitar campos
                            $('#code').prop('disabled', false).val('').focus();
                            $('#verifyBtn').prop('disabled', false);
                            
                            Swal.fire({
                                title: '¡Código reenviado!',
                                text: 'Se ha enviado un nuevo código a tu email',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al reenviar el código',
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    }
                });
            }
            
            // Evento para reenviar código
            $('#resendCode').click(function() {
                resendCode();
            });
        });
    </script>
</body>
</html>
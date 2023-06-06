<!DOCTYPE html>
<html lang="es">

<head>
  <title>Bienvenido</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="../../images/gustitos.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
<div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3">
              <span>Iniciar Sesión</span>
              <span>Registrarse</span>
            </h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Bienvenido!!</h4>
                      <div class="form-group">
                        <input type="text" id="usuario" class="form-style" placeholder="Usuario">
                        <i class="input-icon uil uil-user"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="password" id="clave" class="form-style" placeholder="Password">
                        <i class="input-icon uil uil-lock-alt"></i>
                        
                      </div>
                      <button class="btn mt-4" id="iniciar-sesion">Login</button>
                      <p class="mb-0 mt-4 text-center">
                        <a href="https://wa.me/970526015" class="link">¿Olvidaste tu contraseña?</a>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <form action="../../controllers/usuario.controller.php" method="post">
                      <h4 class="mb-3 pb-3">Forma Parte de Nosotros</h4>
                        <div class="form-group">
                            <input type="text" class="form-style" placeholder="Nombres" name="nombres">
                            <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-style" placeholder="Apellidos" name="apellidos">
                            <i class="input-icon uil uil-comment-dots"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-style" placeholder="Usuario" name="nombreusuario">
                            <i class="input-icon uil uil-user-check"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" class="form-style" placeholder="Contraseña" name="claveacceso">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <button type="submit" class="btn mt-4" name="operacion" value="registrar">Registrarse</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
      function iniciarSesion() {
        const usuario = $('#usuario').val();
        const clave = $('#clave').val();

        if (usuario != "" && clave != "") {
          $.ajax({
            url: '../../controllers/usuario.controller.php',
            type: 'POST',
            data: {
                operacion: 'login',
                nombreusuario: usuario,
                claveIngresada: clave
            },
            dataType: 'JSON',
            success: function (result){
              console.log(result);
              if (result["status"]) {
                Swal.fire({
                  icon: 'success',
                  title: '¡Ingreso exitoso!',
                  text: 'Serás redirigido en 2 segundos.',
                  showConfirmButton: false, // Eliminar el botón "OK"
                  timer: 2000, // tiempo en milisegundos
                  timerProgressBar: true,
                  willClose: () => {
                    window.location.href = "nose.php";
                  }
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: result["mensaje"]
                });
              }
            }
          });
        }
      }
      

      $("#iniciar-sesion").click(iniciarSesion);
      $("#clave").keypress(function(e) {
        if (e.which == 13) { // 13 representa la tecla "Enter"
          iniciarSesion();
        }
      });
      const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('registroExitoso')) {
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'Ahora puedes iniciar sesión con tus credenciales.',
            showConfirmButton: false,
            timer: 3000
        });
        }
    });

    
    // Esperar a que el documento se cargue completamente
    $(document).ready(function() {
        // Obtener el parámetro de URL "registroExitoso"
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('registroExitoso')) {
            Swal.fire({
                icon: 'success',
                title: '¡Registro exitoso!',
                text: 'Ahora puedes iniciar sesión con tus credenciales.',
                showConfirmButton: false,
                timer: 3000
            });

            // Remover el parámetro "registroExitoso" de la URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });

    
  </script>
</body>

</html>

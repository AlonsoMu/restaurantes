

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
  <title>Bienvenido</title>

  <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS v5.2.1 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Íconos de Bootstrap-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
</head>
<body>
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <!-- INICIO DE CARD -->
        <div class="card">
          <div class="card-header bg-info text-light">
           <strong>Inicio de sesión</strong>
          </div>
          
          <div class="card-body">
            <!--<img src="views/img/fotografias/programador.png">-->
            <form action="" autocomplete="off">
              <div class="mb-3">
                <label for="usuario" class="form-label">
                  <i class="fa-solid fa-user"></i>
                  Usuario:
                </label>
                <input type="text" id="usuario" class="form-control form-control-sm"  placeholder="Ingrese su usuario">
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">
                  <i class="fa-solid fa-lock"></i>
                  Contraseña:
                </label>
                <input type="password" id="clave" class="form-control form-control-sm" placeholder="******">
              </div>
            </form>
          </div>
          <div class="card-footer text-center">
            <!--<button type="button" id="crear-usuario" class="btn btn-sm btn-warning">Crear Usaurio</button>-->
            <!--<button type="button" id="btn-regresar" class="btn btn-sm btn-danger" ><i class="fa-solid fa-left-long"></i> Regresar</button>-->
            <button type="button" id="iniciar-sesion" class="btn btn-sm btn-success" >Iniciar Sesión <i class="fa-solid fa-right-to-bracket"></i></button>
          </div>
        </div>
        <!-- FIN DE CARD-->
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
  <!--<a href="views/estudiantes.php">Acceder al sistema</a>-->

  <script>
    $(document).ready(function (){

      function iniciarSesion(){
        const usuario = $("#usuario").val();
        const clave   = $("#clave").val();

        if(usuario != "" && clave != ""){
          
          $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion : 'login',
              nombreusuario : usuario,
              claveIngresada : clave

            },
            dataType: 'JSON',
            success: function (result){
              console.log(result);
              if (result["status"]) {
                Swal.fire({
                  icon: 'success',
                  title: '¡Ingreso exitoso!',
                  text: 'Serás redirigido en 2 segundos.',
                  timer: 2000, // tiempo en milisegundos
                  timerProgressBar: true,
                  willClose: () => {
                    window.location.href = "views/entrada.php";
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


    });
  </script>
</body>
</html>
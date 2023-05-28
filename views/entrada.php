<?php
session_start();
if (!isset($_SESSION["login"])) {
  // Redirigir al usuario a la página de inicio de sesión
  header("Location: ../iniciar.php");
  exit(); // Asegura que el script se detenga después de la redirección
}
?>
<!doctype html>
<html lang="es">

<head>
  <title>Ingreso Administrativo</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Íconos de Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <link rel="shortcut icon" href="../images/gustitos.jpg">

  <style>
    body {
      background-image: url('../images/fondo.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    h1 {
      text-align: center;
      color: #ffffff;
      padding: 20px;
    }

    .button-container {
      display: flex;
      justify-content: center;
    }

    .button {
      background-color: #f5f5f5;
      border: none;
      color: #000000;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .button:hover {
      background-color: #e7e7e7;
    }

    .image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-bottom: 20px;
    }

    .image {
      width: 250px;
      margin-right: 10px;
    }
    .logout-button {
      position: absolute;
      top: 10px;
      right: 10px;
    }
  </style>
</head>

<body>
  <h1>BIENVENIDO AL SISTEMA</h1>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="image-container">
          <a href="mozos.php">
            <img src="../images/mozo.jpg" alt="Imagen 1" class="image">
          </a>
          <br>
          <div class="button-container">
          <button class="button" onclick="location.href='mozos.php';">Mozos</button>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="image-container">
          <a href="recepcionistas.php">
            <img src="../images/recepcionista.jpg" alt="Imagen 2" class="image">
          </a>
          <br>
          <div class="button-container">
          <button class="button" onclick="location.href='recepcionistas.php';">Recepcionista</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="image-container">
          <a href="ruta3.html">
            <img src="../images/caja.jpg" alt="Imagen 3" class="image">
          </a>
          <br>
          <div class="button-container">
            <button class="button">Caja</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function logout() {
            window.location.href = "../iniciar.php";
        }
    </script>

  
  <!-- Logout button -->
  <button class="btn btn-danger logout-button" onclick="logout()">
      <i class="bi bi-box-arrow-left"></i>
      Cerrar Sesión
  </button>

  <script>
  function logout() {
    Swal.fire({
      icon: 'warning',
      title: '¿Estás seguro?',
      text: '¿Deseas cerrar sesión?',
      showCancelButton: true,
      confirmButtonText: 'Si', // Eliminar el texto "OK"
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // Realizar una solicitud AJAX para destruir la sesión
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            Swal.fire({
              icon: 'success',
              title: 'Cierre de sesión exitoso',
              text: 'La sesión se ha cerrado correctamente.',
              showConfirmButton: false, // Eliminar el botón de confirmación
              timer: 2000,
              timerProgressBar: true,
              willClose: () => {
                // Redirigir a la página de inicio de sesión
                window.location.href = '../iniciar.php';
              }
            });
          }
        };
        xhttp.open("GET", "../controllers/usuario.controller.php?operacion=finalizar", true);
        xhttp.send();
      }
    });
  }
</script>


</body>

</html>

<?php
session_start();
require_once '../models/Usuario.php';

if (isset($_POST['operacion'])){

    $usuario = new Usuario();
  
    //Identificando la operacion...
    if ($_POST['operacion'] == 'login'){
  
      $registro = $usuario->iniciarSesion($_POST['nombreusuario']);
  
      $_SESSION["login"] = false;
  
      //Objeto para contener el resultado
      $resultado = [
          "status"    => false,
          "mensaje"   => ""
      ];
  
      if($registro){
        //El usuario si existe
        $claveEncriptada = $registro["claveacceso"];
        
        //Validar la contraseña
        if (password_verify($_POST['claveIngresada'],$claveEncriptada)){
          $resultado["status"] = true;
          $resultado["mensaje"] = "Bienvenido al sistema";
          $_SESSION["login"] = true;
  
        }else{
          $resultado["mensaje"] = "Error en la contraseña";
        }
  
      }else{
        //El usuario NO existe
        $resultado["mensaje"] = "No encontramos al usuario";
      }
  
      // Enviamos el objeto resultado a la vista
      echo json_encode($resultado);
  
    }

    if($_POST['operacion'] == 'listar'){

      $datosObtenidos = $usuario->listarUsuarios();
  
      // PASO 1: Verificar que el objeto contenga datos
      if($datosObtenidos){
        $numeroFila = 1;
        // PASO 2. Recorrer todo el objeto
        foreach($datosObtenidos as $usuario){ // INICIO DEL FOREACH
          // PASO 3: Ahora construimos las filas
          echo "
            <tr>
              <td>{$numeroFila}</td>
              <td>{$usuario['nombres']}</td>
              <td>{$usuario['apellidos']}</td>
              <td>{$usuario['nombreusuario']}</td>
              <td>{$usuario['fecha_registro']}</td>
              <td>
                  <a href='#' data-idusuario='{$usuario['idusuario']}' class='btn btn-danger btn-sm eliminar'><i class='fa-solid fa-trash-can'></i></a>
                  <a href='#' data-idusuario='{$usuario['idusuario']}' class='btn btn-primary btn-sm editar'><i class='fa-solid fa-pencil'></i></a>
              </td>
            </tr>
          ";
            $numeroFila++;
        } // FIN DEL FOREACH
      }
    }
    if($_POST['operacion'] == 'registrar'){
      $datosForm = [
        'nombres'         => $_POST['nombres'],
        'apellidos'       => $_POST['apellidos'],
        'nombreusuario'   => $_POST['nombreusuario'],
        'claveacceso'     => $_POST['claveacceso'],   
      ];

       // Encriptar la contraseña
      $datosForm['claveacceso'] = password_hash($datosForm['claveacceso'], PASSWORD_DEFAULT);
      $usuario->registrarUsuario($datosForm);

      // Redirigir a la página de inicio de sesión con el parámetro "registroExitoso" en la URL
      header('Location: ../iniciar.php?registroExitoso=true');
      exit();
      
    }
  
    if($_POST['operacion'] == 'eliminar'){
      $usuario->eliminarUsuario($_POST['idusuario']);
    }
  
    if($_POST['operacion'] == 'obtenerusuario'){
      $registro = $usuario->getUsuario($_POST['idusuario']);
      echo json_encode($registro);
    }
  
    
    if($_POST['operacion'] == 'actualizar'){
      // PAso 1: Recoger los datos que nos envía la vista (FROM, utilizando AJAX)
      // $_POST: Esto es lo que se nos envía desde FORM
      $datosForm = [
        'idusuario'       => $_POST['idusuario'],
        'nombres'         => $_POST['nombres'],
        'apellidos'       => $_POST['apellidos'],
        'nombreusuario'   => $_POST['nombreusuario'],
        'claveacceso'     => $_POST['claveacceso']
      ];
  
      // Paso 2: Enviar el arreglo como parámetro del método ACTUALIZAR
      $usuario->actualizarUsuario($datosForm);
    }
  }
  
  
  
  
  //Interceptar valores que llegan por la URL
  if (isset($_GET['operacion'])){
  
    if($_GET['operacion'] == 'finalizar'){
      session_destroy();
      session_unset();
      header('Location:../views/dashboard/iniciar.php');
    }
}
    
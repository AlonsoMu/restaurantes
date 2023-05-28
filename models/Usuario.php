<?php

require_once 'Conexion.php';

class Usuario extends Conexion{
    private $accesoBD; //Conexion

    public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function iniciarSesion($nombreUsuario = ""){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_login(?)");
      $consulta->execute(array($nombreUsuario));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    
    }
    catch (Exception $e) {
      die($e ->getMessage());
    }
  }
  // Método listar Usuarios
  public function listarUsuarios(){
    try {
      // 1. Preparamos la consulta
     $consulta = $this->accesoBD->prepare("CALL spu_acceso_listar()");
     // 2. Ejecutamos la consulta
     $consulta->execute();
     // 3. Devolvemos el resultado
     return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   // REGISTRO DE USUARIO
   public function registrarUsuario($datos = []){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_registrar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos["nombres"],
          $datos["apellidos"],
          $datos["nombreusuario"],
          $datos["claveacceso"]
        )
      );
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function eliminarUsuario($idusuario = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_eliminar(?)");
      $consulta->execute(array($idusuario));
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function getUsuario($idusuario = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_recuperar_id(?)");
      $consulta->execute(array($idusuario));
      //RETORNA
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function actualizarUsuario($datos = []){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_actualizar(?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["idusuario"],
          $datos["nombres"],
          $datos["apellidos"],
          $datos["nombreusuario"],
          $datos["claveacceso"]
        )
      );
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }
}
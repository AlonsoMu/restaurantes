<?php

require_once "Conexion.php";

//MODELO = CONTIENE LA LÓGICA
// extends : HERENCIA (POO) en PHP
class Recepcionista extends Conexion{

  // Objeto que almacena la conexión que viene desde el padre (Conexion) y la compartirá con todos los métodos (CRUD+)
  private $accesoBD;

  // Constructor
  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); //El valor de retorno de esta funcion ha sido asignada a este objeto. Si getConexion devuelve el retorno al acceso.
  }

  public function listarPedidos(){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_recepcionista_listar()");
      // 2. Ejecutamos la consulta
      $consulta->execute();
      // 3. Devolvemos la consulta(array asociativo)
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
        
    }
    catch (Exception $e) {
        die($e->getMessage());    
    }
  }

  public function registrarPedidos($datos = []){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_recepcionistas_registrar(?,?,?,?,?)");
      //2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombre"],
          $datos["entrada"],
          $datos["menu"],
          $datos["descripcion"],
          $datos["total"]
        )
      );
    } catch (Exception $e) {
          die($e->getMessage());
    }
  }

  public function actualizarPedido($datos = []){
    try {
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_recepcionistas_actualizar(?,?,?,?,?,?)");
      //2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["idrecepcionista"],
          $datos["nombre"],
          $datos["entrada"],
          $datos["menu"],
          $datos["descripcion"],
          $datos["total"]
        )
      );
    }
    catch (Exception $e) {
      die($e->getMessage());
    }  
  }

  public function getPedido($idmozo = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_recepcionistas_recuperar_ids(?)");
      $consulta->execute(array($idmozo));
      //Retornar el registro encontrado
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function eliminarPedido($idrecepcionista = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_recepcionistas_eliminar(?)");
      $consulta->execute(array($idrecepcionista));
    }
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

}
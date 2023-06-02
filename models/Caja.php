<?php
require_once "Conexion.php";

class Caja extends Conexion {
    private $accesoBD;

    public function __construct() {
        $this->accesoBD = parent::getConexion();
    }

    public function obtenerPedidosPorFecha($anio, $mes, $dia) 
    {
        try {
            $consulta = $this->accesoBD->prepare("CALL spu_suma_obtenerPedidosPorFecha(?, ?, ?)");
            $consulta->bindParam(1, $anio, PDO::PARAM_INT);
            $consulta->bindParam(2, $mes, PDO::PARAM_INT);
            $consulta->bindParam(3, $dia, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPedidosPorMes($anio, $mes) {
        try {
            $consulta = $this->accesoBD->prepare("CALL spu_tiempo_obtenerPedidosPorFecha(?, ?)");
            $consulta->bindParam(1, $anio, PDO::PARAM_INT);
            $consulta->bindParam(2, $mes, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
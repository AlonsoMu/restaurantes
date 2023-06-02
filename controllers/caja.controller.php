<?php
require_once "../models/Caja.php";

$caja = new Caja();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["fecha"])) { // Verificar si se ha enviado la clave "fecha"
        $fecha = $_POST["fecha"];

        // Obtener año, mes y día de la fecha seleccionada
        $anio = date("Y", strtotime($fecha));
        $mes = date("m", strtotime($fecha));
        $dia = date("d", strtotime($fecha));

        // Obtener los pedidos por día
        $pedidosDia = $caja->obtenerPedidosPorFecha($anio, $mes, $dia);

        // Obtener los totales por día
        $total_mozos_dia = isset($pedidosDia[0]['total_mozos']) ? $pedidosDia[0]['total_mozos'] : 0;
        $total_recepcionistas_dia = isset($pedidosDia[0]['total_recepcionistas']) ? $pedidosDia[0]['total_recepcionistas'] : 0;
        $total_general_dia = isset($pedidosDia[0]['total_general']) ? $pedidosDia[0]['total_general'] : 0;

        // Pasar los datos por día a la vista
        $datosDia = [
            'total_mozos_dia' => $total_mozos_dia,
            'total_recepcionistas_dia' => $total_recepcionistas_dia,
            'total_general_dia' => $total_general_dia
        ];

        echo json_encode($datosDia);
    } elseif (isset($_POST["fechaMes"])) { // Verificar si se ha enviado la clave "fechaMes"
        $fechaMes = $_POST["fechaMes"];

        // Obtener año y mes de la fecha seleccionada para el cálculo mensual
        $anioMes = date("Y-m", strtotime($fechaMes));
        $anio = date("Y", strtotime($fechaMes));
        $mes = date("m", strtotime($fechaMes));

        // Obtener los pedidos por mes
        $pedidosMes = $caja->obtenerPedidosPorMes($anio, $mes);

        // Obtener los totales por mes
        $total_mozos_mes = isset($pedidosMes[0]['total_mozos']) ? $pedidosMes[0]['total_mozos'] : 0;
        $total_recepcionistas_mes = isset($pedidosMes[0]['total_recepcionistas']) ? $pedidosMes[0]['total_recepcionistas'] : 0;
        $total_general_mes = isset($pedidosMes[0]['total_general']) ? $pedidosMes[0]['total_general'] : 0;

        // Pasar los datos por mes a la vista
        $datosMes = [
            'total_mozos_mes' => $total_mozos_mes,
            'total_recepcionistas_mes' => $total_recepcionistas_mes,
            'total_general_mes' => $total_general_mes
        ];

        echo json_encode($datosMes);
    }
}
?>

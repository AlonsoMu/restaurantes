<?php
require_once '../models/Mozo.php';
require_once '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

if(isset($_POST['operacion'])){
    $mozo = new Mozo();
    if($_POST['operacion'] == 'listar'){
        $datosobtenidos = $mozo->listarPedidos();

        if($datosobtenidos){
            $numeroFila = 1;
            foreach($datosobtenidos as $mozo){
                echo "
                <tr>
                    <td>{$numeroFila}</td>
                    <td>{$mozo['mesa']}</td>
                    <td>{$mozo['entrada']}</td>
                    <td>{$mozo['menu']}</td>
                    <td>{$mozo['descripcion']}</td>
                    <td>{$mozo['total']}</td>
                    <td> 
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-warning btn-sm imprimir' onclick='imprimirTicket({$mozo['idmozo']})'><i class='bi bi-printer'></i></a>
                    </td>
                    </tr>
                ";
                $numeroFila++;
            }
        }
    }

    if($_POST['operacion'] == 'registrar'){
        $datosForm = [
            "mesa"         => $_POST['mesa'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $mozo->registrarPedidos($datosForm);
        
    }

    if($_POST['operacion'] == 'actualizar'){
        $datosForm = [
            "idmozo"        => $_POST['idmozo'],
            "mesa"         => $_POST['mesa'], //CLAVES // VALORES
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
          ];
      
          //Paso 2: Enviar el arreglo como paramentro del metodo ACTUALIZAR
            $mozo->actualizarPedido($datosForm);

    }

    if($_POST['operacion'] == 'obtenerpedido'){
        $registro = $mozo->getPedido($_POST['idmozo']);
        echo json_encode($registro);
      }

    if($_POST['operacion'] == 'eliminar'){
        $mozo->eliminarPedido($_POST['idmozo']);
    }


    if ($_POST['operacion'] == 'imprimirTicket') {
        $idmozo = $_POST['idmozo'];
    
        // Obtener los detalles del pedido con el ID proporcionado
        $pedido = $mozo->getPedido($idmozo);

        try {
        
            if ($pedido) {
                $mesa = $pedido['mesa'];
                $entrada = $pedido['entrada'];
                $menu = $pedido['menu'];
                $descripcion = $pedido['descripcion'];
                $total = $pedido['total'];
        
                // Crear instancia de Printer y conectar con la impresora
                $connector = new WindowsPrintConnector('EPSON TM-T20IIIL Receipt');
                $printer = new Printer($connector);
        
                // Enviar contenido del ticket a imprimir
                $printer->text("¡Bienvenido a nuestro restaurante!\n");
                $printer->text("Mesa: {$mesa}\n");
                $printer->text("Entrada: {$entrada}\n");
                $printer->text("Menú: {$menu}\n");
                $printer->text("Descripción: {$descripcion}\n");
                $printer->text("Total: {$total}\n");
        
                // Cortar el papel
                $printer->cut();
        
                // Cerrar la conexión con la impresora
                $printer->close();
        
                // Respuesta de éxito
                echo json_encode(["success" => true]);
            } else {
                // Respuesta de error
                echo json_encode(["success" => false, "message" => "No se encontró el pedido"]);
            }
        } catch (Exception $e) {
            // Respuesta de error en caso de excepción
            echo json_encode(["success" => false, "message" => "Error al generar el ticket: " . $e->getMessage()]);
        }
    }
}


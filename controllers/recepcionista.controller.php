<?php

require_once '../models/Recepcionista.php';

if (isset($_POST['operacion'])) {
    $recepcionista = new Recepcionista();
    if ($_POST['operacion'] == 'listar') {
        $datosobtenidos = $recepcionista->listarPedidos();

        if ($datosobtenidos) {
            $numeroFila = 1;
            foreach ($datosobtenidos as $recepcionista) {
                echo "
                <tr>
                    <td>{$numeroFila}</td>
                    <td>{$recepcionista['nombre']}</td>
                    <td>{$recepcionista['entrada']}</td>
                    <td>{$recepcionista['menu']}</td>
                    <td>{$recepcionista['descripcion']}</td>
                    <td>{$recepcionista['total']}</td>
                    <td> 
                    <a href='#' data-idrecepcionista='{$recepcionista['idrecepcionista']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
                    <a href='#' data-idrecepcionista='{$recepcionista['idrecepcionista']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
                    </td>
                    </tr>
                ";
                $numeroFila++;
            }
        }
    }

    if ($_POST['operacion'] == 'registrar') {
        $datosForm = [
            "nombre"         => $_POST['nombre'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $recepcionista->registrarPedidos($datosForm);
    }

    if ($_POST['operacion'] == 'actualizar') {
        $datosForm = [
            "idrecepcionista"        => $_POST['idrecepcionista'],
            "nombre"         => $_POST['nombre'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $recepcionista->actualizarPedido($datosForm);
    }

    if($_POST['operacion'] == 'obtenerpedido'){
        $registro = $recepcionista->getPedido($_POST['idrecepcionista']);
        echo json_encode($registro);
      }

    if($_POST['operacion'] == 'eliminar'){
        $recepcionista->eliminarPedido($_POST['idrecepcionista']);
    }
}


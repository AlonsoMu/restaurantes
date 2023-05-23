<?php
include('../models/Conexion.php');
?>

<!doctype html>
<html lang="es">

<head>
  <title>RESTAURANTE GUSTITOS</title>
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
    .centered-text {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      font-family: "Arial", sans-serif; /* Cambia el tipo de letra según tus necesidades */
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo img {
        width: 50px; /* Ajusta el tamaño del logo según tus necesidades */
        margin-right: 10px; /* Ajusta el margen derecho del logo según tus necesidades */
    }
    </style>
    

</head>

<body>
    <div class="container mt-3">
        <div class="card table-responsive">
        <div class="card-header bg-primary text-light">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
                        <img src="../images/gustitos.jpg" alt="Logo Gustitos">
                        <strong class="centered-text">GUSTITOS</strong>
                    </div>
                </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-registro-pedidos"><i class="bi bi-plus-square-fill"></i> Agregar pedido</button>

            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-sm table-striped" id="tabla-pedidos">
            <colgroup> <!-- Permite ordenar las tablas-->
                <col width = "5%">
                <col width = "10%">
                <col width = "15%">
                <col width = "20%">
                <col width = "20%">
                <col width = "10%">
                <col width = "10%">
                
            </colgroup>
            <thead>
                <tr>
                <th>#</th>
                <th>N° Mesa</th>
                <th>Entrada</th>
                <th>Menú</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            </table>
        </div>
        </div>

        </div>
    </div>


    
    

        


    <!--Modales-->
    <!-- Modal trigger button -->

    
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modal-registro-pedidos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-light">
                    <h5 class="modal-title" id="modal-titulo">Registro de Pedidos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formulario-pedidos" autocomplete="off">
                        <div class="mb-3">
                                <label for="mesa" class="form-label">Mesa:</label>
                                <input type="text" class="form-control form-control-sm" id="mesa" name="mesa">
                            </div>
                        <div class="mb 3">
                            <label for="entrada" class="form-label">Entrada:</label>
                            <input type="text" class="form-control form-control-sm" id="entrada" name="entrada">
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Menu:</label>
                            <input type="text" class="form-control form-control-sm" id="menu" name="menu">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="total">Precio:</label>
                            <input type="text" class="form-control form-control-sm" id="total" name="total" required>
                        </div>

                        <script>
                            // Obtener el campo de entrada de precio
                            var precioInput = document.getElementById("total");

                            // Agregar un controlador de eventos para validar la entrada de usuario
                            precioInput.addEventListener("input", function() {
                                // Obtener el valor actual del campo de entrada
                                var valor = this.value;

                                // Eliminar cualquier caracter que no sea número del valor
                                valor = valor.replace(/[^0-9]/g, "");

                                // Establecer el nuevo valor en el campo de entrada
                                this.value = valor;
                            });
                        </script>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success" id="guardar-pedido">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
    
    

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">


  </script>

    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>

    $(document).ready(function (){

        let datosNuevos = true;
        let idmozoactualizar = -1;

    function mostrarPedidos(){
        $.ajax({
            url: '../controllers/mozo.controller.php',
            type: 'POST',
            data: {operacion: 'listar'},
            dataType: 'text',
            success: function(result){
                $("#tabla-pedidos tbody").html(result);
            }
        });
    }   

    mostrarPedidos(); 

    function registrarPedido(){
        if(confirm("Está seguro de registrar un pedido?")){

            let datos = {
                operacion   : 'registrar',
                idmozo      : idmozoactualizar,
                mesa       : $("#mesa").val(),
                entrada     : $("#entrada").val(),
                menu        : $("#menu").val(),
                descripcion : $("#descripcion").val(),
                total       : $("#total").val()
            };

            if(!datosNuevos){
                datos["operacion"] = "actualizar";
            }

            $.ajax({
                url: '../controllers/mozo.controller.php',
                type: 'POST',
                data: datos,
                success: function(result){
                    if(result == ""){
                        $("#formulario-pedidos")[0].reset();

                        mostrarPedidos();

                        $("#modal-registro-pedidos").modal('hide');
                    }
                }
            });
        }
    }

    function abrirModal(){
        datosNuevos = true;
        $("#modal-titulo").html("Registro de pedidos");
        $("#formulario-pedidos")[0].reset();
      }

      $("#guardar-pedido").click(registrarPedido);
      $("#abrir-modal").click(abrirModal);
    
      //EDITAR

     $("#tabla-pedidos tbody").on("click",".editar", function(){
        const idpedidoeditar = $(this).data("idmozo");
        
        $.ajax({
            url:'../controllers/mozo.controller.php',
            type: 'POST',
            data: {
                operacion : 'obtenerpedido',
                idmozo    : idpedidoeditar
            },
            dataType: 'JSON',
            success: function(result){
                console.log(result);

                datosNuevos = false

                idmozoactualizar = result["idmozo"];
                $("#mesa").val(result["mesa"]);
                $("#entrada").val(result["entrada"]);
                $("#menu").val(result["menu"]);
                $("#descripcion").val(result["descripcion"]);
                $("#total").val(result["total"]);

                $("#modal-titulo").html("Actualizar datos de pedido");

                // Ponemos al modal en pantalla
                $("#modal-registro-pedidos").modal("show");
            }
        });
     });

     $("#tabla-pedidos tbody").on("click",".eliminar",function(){
        const idpedidoEliminar = $(this).data("idmozo");
        if(confirm("¿Está seguro de eliminar el pedido?")){
            $.ajax({
                url: '../controllers/mozo.controller.php',
                type: 'POST',
                data: {
                    operacion : 'eliminar',
                    idmozo : idpedidoEliminar
                },
                success: function(result){
                    if(result == ""){
                        mostrarPedidos();
                    }
                }
            });
        }
     });

     function imprimirTicket(idmozo) {
        // Realizar una solicitud AJAX para obtener los detalles del mozo
        $.ajax({
            url: '../controllers/mozo.controller.php',
            type: 'POST',
            data: { operacion: 'obtenerpedido', idmozo: idmozo },
            dataType: 'json',
            success: function (data) {
                // Llamar a la función de impresión pasando los detalles del mozo
                imprimir(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

        function imprimir(data) {
        // Crear una nueva instancia de la clase de impresión
        let printer = new ThermalPrinter();

        // Establecer las configuraciones de impresión
        printer.setPrinterDriver(new PrinterDriverConsole());
        printer.setPrintCommand(new PrintCommandESCPOS());
        printer.setEncoding('CP437');
        printer.setDensity(8, 8);

        // Agregar los datos del mozo al ticket
        printer.setTextDoubleHeight(true);
        printer.setTextDoubleWidth(true);
        printer.setTextAlignment('center');
        printer.printLine('Detalles del Mozo');
        printer.setTextDoubleHeight(false);
        printer.setTextDoubleWidth(false);
        printer.setTextAlignment('left');
        printer.printLine('Mesa: ' + data.mesa);
        printer.printLine('Entrada: ' + data.entrada);
        printer.printLine('Menú: ' + data.menu);
        printer.printLine('Descripción: ' + data.descripcion);
        printer.setTextDoubleHeight(true);
        printer.setTextDoubleWidth(true);
        printer.setTextAlignment('right');
        printer.printLine('Total: ' + data.total);
        printer.setTextDoubleHeight(false);
        printer.setTextDoubleWidth(false);
        printer.feed(3);
        printer.cut();

        // Enviar los datos a la impresora
        printer.send();

        // Mostrar un mensaje de éxito en la consola
        console.log('El ticket se ha enviado a la impresora térmica.');
    }

     // Ejecución automática
     mostrarPedidos();




    });
    </script>
</body>

</html>
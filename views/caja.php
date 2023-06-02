<!DOCTYPE html>
<html>
<head>
    <title>Pedidos</title>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        .pagination li {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Pedidos por día</h2>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" class="form-control">
            </div>
            <button type="button" id="btnAbrirModal" class="btn btn-primary" onclick="obtenerPedidos()">Mostrar Pedidos</button>
        </div>
    </div>

    <hr>

    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Pedidos al Mes: <span id="numeroPedidos"></span></h3>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <label for="fecha-mes">Selecciona un año y mes:</label>
            <div class="input-group">
                <input type="month" id="fecha-mes" class="form-control">
                <button id="calcular-mes-btn" class="btn btn-primary">Calcular</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar el precio total del mes -->
<div id="modal-mes" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Precio total del mes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="precio-mes"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar el total de pedidos del día -->
<div id="pedidoModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Total de Pedidos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h6>Pedidos de Mozos:</h6>
                        <p id="totalMozosDia"></p>
                    </div>
                    <div class="col">
                        <h6>Pedidos de Recepcionistas:</h6>
                        <p id="totalRecepcionistasDia"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Total General de Pedidos:</h6>
                        <p id="totalGeneralDia"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    function obtenerPedidos() {
        var fecha = $('#fecha').val();

        if (fecha) {
            $.ajax({
                url: '../controllers/caja.controller.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    fecha: fecha
                },
                success: function (response) {
                    mostrarModalPedidos(response.total_mozos_dia, response.total_recepcionistas_dia, response.total_general_dia);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    function mostrarModalPedidos(totalMozosDia, totalRecepcionistasDia, totalGeneralDia) {
        $('#totalMozosDia').text(totalMozosDia);
        $('#totalRecepcionistasDia').text(totalRecepcionistasDia);
        $('#totalGeneralDia').text(totalGeneralDia);

        $('#pedidoModal').modal('show');
    }

    $(document).ready(function() {
        $('#calcular-mes-btn').click(function() {
            var fechaMes = $('#fecha-mes').val();

            if (fechaMes) {
                $.ajax({
                    url: '../controllers/caja.controller.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        fechaMes: fechaMes
                    },
                    success: function(response) {
                        var precioMes = response.total_general_mes;
                        $('#precio-mes').text("Precio total del mes: " + precioMes);
                        $('#modal-mes').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

</script>
</body>
</html>

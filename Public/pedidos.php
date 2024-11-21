<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Pedidos</h1>

        <!-- Formulario para agregar/editar pedido -->
        <form id="formPedido" method="POST" action="PedidosController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Pedido" id="ID_Pedido"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="ID_Hotel" class="form-label">Hotel</label>
                    <select name="ID_Hotel" id="ID_Hotel" class="form-select" required>
                        <option value="">Seleccionar Hotel</option>
                        <?php
                        require_once 'HotelesController.php';
                        $hotelesController = new HotelesController();
                        $hoteles = $hotelesController->getAll();

                        foreach ($hoteles as $hotel) {
                            echo "<option value='{$hotel['ID_Hotel']}'>{$hotel['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="ID_Suministro" class="form-label">Suministro</label>
                    <select name="ID_Suministro" id="ID_Suministro" class="form-select" required>
                        <option value="">Seleccionar Suministro</option>
                        <?php
                        require_once 'SuministrosController.php';
                        $suministrosController = new SuministrosController();
                        $suministros = $suministrosController->getAll();

                        foreach ($suministros as $suministro) {
                            echo "<option value='{$suministro['ID_Suministro']}'>{$suministro['Descripcion']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="Cantidad" id="Cantidad" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Fecha_Pedido" class="form-label">Fecha de Pedido</label>
                    <input type="date" class="form-control" name="Fecha_Pedido" id="Fecha_Pedido" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar los pedidos -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Hotel</th>
                    <th>Suministro</th>
                    <th>Cantidad</th>
                    <th>Fecha de Pedido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'PedidosController.php';
                $controller = new PedidosController();
                $pedidos = $controller->getAll();

                foreach ($pedidos as $pedido) {
                    echo "<tr>
                        <td>{$pedido['ID_Pedido']}</td>
                        <td>{$pedido['Hotel']}</td>
                        <td>{$pedido['Suministro']}</td>
                        <td>{$pedido['Cantidad']}</td>
                        <td>{$pedido['Fecha_Pedido']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarPedido(" . json_encode($pedido) . ")'>Editar</button>
                            <a href='PedidosController.php?accion=eliminar&ID_Pedido={$pedido['ID_Pedido']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarPedido(pedido) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Pedido').value = pedido.ID_Pedido;
            document.getElementById('ID_Hotel').value = pedido.ID_Hotel;
            document.getElementById('ID_Suministro').value = pedido.ID_Suministro;
            document.getElementById('Cantidad').value = pedido.Cantidad;
            document.getElementById('Fecha_Pedido').value = pedido.Fecha_Pedido;
        }
    </script>
</body>
</html>

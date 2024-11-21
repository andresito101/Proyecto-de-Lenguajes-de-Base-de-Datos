<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos de Suministros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Pedidos de Suministros</h1>

        <!-- Formulario para agregar/editar pedido suministro -->
        <form id="formPedidoSuministro" method="POST" action="PedidosSuministrosController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Pedido" id="ID_Pedido"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="ID_Pedido" class="form-label">Pedido</label>
                    <select name="ID_Pedido" id="ID_Pedido" class="form-select" required>
                        <option value="">Seleccionar Pedido</option>
                        <?php
                        require_once 'PedidosController.php';
                        $pedidosController = new PedidosController();
                        $pedidos = $pedidosController->getAll();

                        foreach ($pedidos as $pedido) {
                            echo "<option value='{$pedido['ID_Pedido']}'>{$pedido['ID_Pedido']}</option>";
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

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar los pedidos suministros -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>ID Suministro</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'PedidosSuministrosController.php';
                $controller = new PedidosSuministrosController();
                $pedidosSuministros = $controller->getAll();

                foreach ($pedidosSuministros as $pedidoSuministro) {
                    echo "<tr>
                        <td>{$pedidoSuministro['ID_Pedido']}</td>
                        <td>{$pedidoSuministro['ID_Suministro']}</td>
                        <td>{$pedidoSuministro['Cantidad']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarPedidoSuministro(" . json_encode($pedidoSuministro) . ")'>Editar</button>
                            <a href='PedidosSuministrosController.php?accion=eliminar&ID_Pedido={$pedidoSuministro['ID_Pedido']}&ID_Suministro={$pedidoSuministro['ID_Suministro']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarPedidoSuministro(pedidoSuministro) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Pedido').value = pedidoSuministro.ID_Pedido;
            document.getElementById('ID_Suministro').value = pedidoSuministro.ID_Suministro;
            document.getElementById('Cantidad').value = pedidoSuministro.Cantidad;
        }
    </script>
</body>
</html>

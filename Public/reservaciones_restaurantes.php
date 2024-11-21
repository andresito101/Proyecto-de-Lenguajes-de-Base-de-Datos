<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones de Restaurantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Reservaciones de Restaurantes</h1>

        <!-- Formulario para agregar/editar una reservación -->
        <form id="formReservacionesRestaurantes" method="POST" action="ReservacionesRestaurantesController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Reservacion" id="ID_Reservacion"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="ID_Restaurante" class="form-label">Restaurante</label>
                    <select name="ID_Restaurante" id="ID_Restaurante" class="form-select" required>
                        <option value="">Seleccionar Restaurante</option>
                        <?php
                        require_once 'RestaurantesController.php';
                        $restaurantesController = new RestaurantesController();
                        $restaurantes = $restaurantesController->getAll();

                        foreach ($restaurantes as $restaurante) {
                            echo "<option value='{$restaurante['ID_Restaurante']}'>{$restaurante['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="ID_Cliente" class="form-label">Cliente</label>
                    <select name="ID_Cliente" id="ID_Cliente" class="form-select" required>
                        <option value="">Seleccionar Cliente</option>
                        <?php
                        require_once 'ClientesController.php';
                        $clientesController = new ClientesController();
                        $clientes = $clientesController->getAll();

                        foreach ($clientes as $cliente) {
                            echo "<option value='{$cliente['ID_Cliente']}'>{$cliente['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="Fecha" id="Fecha" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Estado" class="form-label">Estado de la Reservación</label>
                    <input type="text" class="form-control" name="Estado" id="Estado" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar reservaciones -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Restaurante</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado de la Reservación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'ReservacionesRestaurantesController.php';
                $controller = new ReservacionesRestaurantesController();
                $reservaciones = $controller->getAll();

                foreach ($reservaciones as $reservacion) {
                    echo "<tr>
                        <td>{$reservacion['ID_Reservacion']}</td>
                        <td>{$reservacion['ID_Restaurante']}</td>
                        <td>{$reservacion['ID_Cliente']}</td>
                        <td>{$reservacion['Fecha']}</td>
                        <td>{$reservacion['Estado']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarReservacion(" . json_encode($reservacion) . ")'>Editar</button>
                            <a href='ReservacionesRestaurantesController.php?accion=eliminar&ID_Reservacion={$reservacion['ID_Reservacion']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarReservacion(reservacion) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Reservacion').value = reservacion.ID_Reservacion;
            document.getElementById('ID_Restaurante').value = reservacion.ID_Restaurante;
            document.getElementById('ID_Cliente').value = reservacion.ID_Cliente;
            document.getElementById('Fecha').value = reservacion.Fecha;
            document.getElementById('Estado').value = reservacion.Estado;
        }
    </script>
</body>
</html>

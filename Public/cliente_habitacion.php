<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Habitaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Clientes y Habitaciones</h1>

        <!-- Formulario para agregar/editar la asignación de habitación -->
        <form id="formClienteHabitacion" method="POST" action="ClienteHabitacionController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Cliente" id="ID_Cliente"> <!-- ID para editar -->

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
                    <label for="Num_Habitacion" class="form-label">Número de Habitación</label>
                    <select name="Num_Habitacion" id="Num_Habitacion" class="form-select" required>
                        <option value="">Seleccionar Habitación</option>
                        <?php
                        require_once 'HabitacionesController.php';
                        $habitacionesController = new HabitacionesController();
                        $habitaciones = $habitacionesController->getAll();

                        foreach ($habitaciones as $habitacion) {
                            echo "<option value='{$habitacion['Num_Habitacion']}'>{$habitacion['Num_Habitacion']} - {$habitacion['Tipo_Habitacion']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Fecha_Entrada" class="form-label">Fecha de Entrada</label>
                    <input type="date" class="form-control" name="Fecha_Entrada" id="Fecha_Entrada" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Fecha_Salida" class="form-label">Fecha de Salida</label>
                    <input type="date" class="form-control" name="Fecha_Salida" id="Fecha_Salida" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar cliente - habitación -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre del Cliente</th>
                    <th>Habitación</th>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'ClienteHabitacionController.php';
                $controller = new ClienteHabitacionController();
                $clienteHabitaciones = $controller->getAll();

                foreach ($clienteHabitaciones as $clienteHabitacion) {
                    echo "<tr>
                        <td>{$clienteHabitacion['ID_Cliente']}</td>
                        <td>{$clienteHabitacion['Nombre']}</td>
                        <td>{$clienteHabitacion['Num_Habitacion']}</td>
                        <td>{$clienteHabitacion['Fecha_Entrada']}</td>
                        <td>{$clienteHabitacion['Fecha_Salida']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarClienteHabitacion(" . json_encode($clienteHabitacion) . ")'>Editar</button>
                            <a href='ClienteHabitacionController.php?accion=eliminar&ID_Cliente={$clienteHabitacion['ID_Cliente']}&Num_Habitacion={$clienteHabitacion['Num_Habitacion']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarClienteHabitacion(clienteHabitacion) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Cliente').value = clienteHabitacion.ID_Cliente;
            document.getElementById('Num_Habitacion').value = clienteHabitacion.Num_Habitacion;
            document.getElementById('Fecha_Entrada').value = clienteHabitacion.Fecha_Entrada;
            document.getElementById('Fecha_Salida').value = clienteHabitacion.Fecha_Salida;
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Habitaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Habitaciones</h1>

        <!-- Formulario para agregar/editar una habitación -->
        <form id="formHabitaciones" method="POST" action="HabitacionesController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambia a "editar" si es necesario -->
                <input type="hidden" name="Num_Habitacion" id="Num_Habitacion"> <!-- ID para editar -->

                <div class="col-md-3">
                    <label for="ID_Hotel" class="form-label">ID del Hotel</label>
                    <input type="number" class="form-control" name="ID_Hotel" id="ID_Hotel" required>
                </div>

                <div class="col-md-4">
                    <label for="Tipo_de_Habitacion" class="form-label">Tipo de Habitación</label>
                    <input type="text" class="form-control" name="Tipo_de_Habitacion" id="Tipo_de_Habitacion" required>
                </div>

                <div class="col-md-3">
                    <label for="Precio_por_noche" class="form-label">Precio por Noche</label>
                    <input type="number" class="form-control" name="Precio_por_noche" id="Precio_por_noche" required>
                </div>

                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar habitaciones -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID Hotel</th>
                    <th>Tipo de Habitación</th>
                    <th>Precio por Noche</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'HabitacionesController.php';
                $controller = new HabitacionesController();
                $habitaciones = $controller->getAll();

                foreach ($habitaciones as $habitacion) {
                    echo "<tr>
                        <td>{$habitacion['Num_Habitacion']}</td>
                        <td>{$habitacion['ID_Hotel']}</td>
                        <td>{$habitacion['Tipo_de_Habitacion']}</td>
                        <td>{$habitacion['Precio_por_noche']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarHabitacion(" . json_encode($habitacion) . ")'>Editar</button>
                            <a href='HabitacionesController.php?accion=eliminar&Num_Habitacion={$habitacion['Num_Habitacion']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Rellenar el formulario con los datos para editar
        function editarHabitacion(habitacion) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('Num_Habitacion').value = habitacion.Num_Habitacion;
            document.getElementById('ID_Hotel').value = habitacion.ID_Hotel;
            document.getElementById('Tipo_de_Habitacion').value = habitacion.Tipo_de_Habitacion;
            document.getElementById('Precio_por_noche').value = habitacion.Precio_por_noche;
        }
    </script>
</body>
</html>

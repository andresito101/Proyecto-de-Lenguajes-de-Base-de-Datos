<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios del Hotel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Servicios del Hotel</h1>

        <!-- Formulario para agregar/editar servicio del hotel -->
        <form id="formServicio" method="POST" action="ServicioHotelController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Servicio" id="ID_Servicio"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="Nombre_Servicio" class="form-label">Nombre del Servicio</label>
                    <input type="text" class="form-control" name="Nombre_Servicio" id="Nombre_Servicio" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar los servicios -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Servicio</th>
                    <th>Nombre Servicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'ServicioHotelController.php';
                $controller = new ServicioHotelController();
                $servicios = $controller->getAll();

                foreach ($servicios as $servicio) {
                    echo "<tr>
                        <td>{$servicio['ID_Servicio']}</td>
                        <td>{$servicio['Nombre_Servicio']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarServicio(" . json_encode($servicio) . ")'>Editar</button>
                            <a href='ServicioHotelController.php?accion=eliminar&ID_Servicio={$servicio['ID_Servicio']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarServicio(servicio) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Servicio').value = servicio.ID_Servicio;
            document.getElementById('Nombre_Servicio').value = servicio.Nombre_Servicio;
        }
    </script>
</body>
</html>

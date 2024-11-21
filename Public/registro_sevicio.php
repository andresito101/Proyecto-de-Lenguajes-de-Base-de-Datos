<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Registro de Servicios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Registro de Servicios</h1>

        <!-- Formulario para agregar/editar registro de servicio -->
        <form id="formRegistro" method="POST" action="RegistroServicioController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Servicio" id="ID_Servicio"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="ID_Registro" class="form-label">ID Registro</label>
                    <input type="number" class="form-control" name="ID_Registro" id="ID_Registro" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="Estado" id="Estado" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar los registros de servicio -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Servicio</th>
                    <th>ID Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'RegistroServicioController.php';
                $controller = new RegistroServicioController();
                $registros = $controller->getAll();

                foreach ($registros as $registro) {
                    echo "<tr>
                        <td>{$registro['ID_Servicio']}</td>
                        <td>{$registro['ID_Registro']}</td>
                        <td>{$registro['Estado']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarRegistro(" . json_encode($registro) . ")'>Editar</button>
                            <a href='RegistroServicioController.php?accion=eliminar&ID_Servicio={$registro['ID_Servicio']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarRegistro(registro) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Servicio').value = registro.ID_Servicio;
            document.getElementById('ID_Registro').value = registro.ID_Registro;
            document.getElementById('Estado').value = registro.Estado;
        }
    </script>
</body>
</html>

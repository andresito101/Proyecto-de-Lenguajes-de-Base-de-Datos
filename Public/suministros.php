<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Suministros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Suministros</h1>

        <!-- Formulario para agregar/editar suministro -->
        <form id="formSuministro" method="POST" action="SuministrosController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Suministro" id="ID_Suministro"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="Descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="Descripcion" id="Descripcion" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Fecha_Recepcion" class="form-label">Fecha de Recepción</label>
                    <input type="date" class="form-control" name="Fecha_Recepcion" id="Fecha_Recepcion" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="Estado" id="Estado" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Empresa" class="form-label">Empresa</label>
                    <input type="text" class="form-control" name="Empresa" id="Empresa" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar los suministros -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Suministro</th>
                    <th>Descripción</th>
                    <th>Fecha de Recepción</th>
                    <th>Estado</th>
                    <th>Empresa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'SuministrosController.php';
                $controller = new SuministrosController();
                $suministros = $controller->getAll();

                foreach ($suministros as $suministro) {
                    echo "<tr>
                        <td>{$suministro['ID_Suministro']}</td>
                        <td>{$suministro['Descripcion']}</td>
                        <td>{$suministro['Fecha_Recepcion']}</td>
                        <td>{$suministro['Estado']}</td>
                        <td>{$suministro['Empresa']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarSuministro(" . json_encode($suministro) . ")'>Editar</button>
                            <a href='SuministrosController.php?accion=eliminar&ID_Suministro={$suministro['ID_Suministro']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarSuministro(suministro) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Suministro').value = suministro.ID_Suministro;
            document.getElementById('Descripcion').value = suministro.Descripcion;
            document.getElementById('Fecha_Recepcion').value = suministro.Fecha_Recepcion;
            document.getElementById('Estado').value = suministro.Estado;
            document.getElementById('Empresa').value = suministro.Empresa;
        }
    </script>
</body>
</html>

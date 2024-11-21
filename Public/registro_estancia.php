<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Registro de Estancias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Registro de Estancias</h1>

        <!-- Formulario para agregar/editar estancia -->
        <form id="formEstancia" method="POST" action="RegistroEstanciaController.html">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Estancia" id="ID_Estancia"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="ID_Cliente" class="form-label">Cliente</label>
                    <select name="ID_Cliente" id="ID_Cliente" class="form-select" required>
                        <?php
                        require_once 'ClienteModel.html';
                        $clienteModel = new ClienteModel();
                        $clientes = $clienteModel->getAll();

                        foreach ($clientes as $cliente) {
                            echo "<option value='{$cliente['ID_Cliente']}'>{$cliente['Nombre']} {$cliente['Apellido1']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="ID_Habitacion" class="form-label">Habitación</label>
                    <select name="ID_Habitacion" id="ID_Habitacion" class="form-select" required>
                        
                        require_once 'HabitacionesModel.html';
                        $habitacionesModel = new HabitacionesModel();
                        $habitaciones = $habitacionesModel->getAll();

                        foreach ($habitaciones as $habitacion) {
                            echo "<option value='{$habitacion['ID_Hotel']}|{$habitacion['Num_Habitacion']}'>{$habitacion['Num_Habitacion']} - {$habitacion['Tipo_Habitacion']}</option>";
                        }
                        
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="Fecha_Entrada" class="form-label">Fecha de Entrada</label>
                    <input type="date" class="form-control" name="Fecha_Entrada" id="Fecha_Entrada" required>
                </div>

                <div class="col-md-6">
                    <label for="Fecha_Salida" class="form-label">Fecha de Salida</label>
                    <input type="date" class="form-control" name="Fecha_Salida" id="Fecha_Salida" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar las estancias -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Estancia</th>
                    <th>Cliente</th>
                    <th>Habitación</th>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                require_once 'RegistroEstanciaController.html';
                $controller = new RegistroEstanciaController();
                $estancias = $controller->getAll();

                foreach ($estancias as $estancia) {
                    echo "<tr>
                        <td>{$estancia['ID_Estancia']}</td>
                        <td>{$estancia['Nombre_Cliente']}</td>
                        <td>{$estancia['Num_Habitacion']}</td>
                        <td>{$estancia['Fecha_Entrada']}</td>
                        <td>{$estancia['Fecha_Salida']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarEstancia(" . json_encode($estancia) . ")'>Editar</button>
                            <a href='RegistroEstanciaController.php?accion=eliminar&ID_Estancia={$estancia['ID_Estancia']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                
            </tbody>
        </table>
    </div>

    <script>
        function editarEstancia(estancia) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Estancia').value = estancia.ID_Estancia;
            document.getElementById('ID_Cliente').value = estancia.ID_Cliente;
            document.getElementById('ID_Habitacion').value = estancia.ID_Habitacion;
            document.getElementById('Fecha_Entrada').value = estancia.Fecha_Entrada;
            document.getElementById('Fecha_Salida').value = estancia.Fecha_Salida;
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Clientes</h1>

        <!-- Formulario para agregar/editar un cliente -->
        <form id="formClientes" method="POST" action="ClientesController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambia a "editar" si es necesario -->
                <input type="hidden" name="ID_Cliente" id="ID_Cliente"> <!-- ID para editar -->

                <div class="col-md-4">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                </div>

                <div class="col-md-4">
                    <label for="Apellido1" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" name="Apellido1" id="Apellido1" required>
                </div>

                <div class="col-md-4">
                    <label for="Apellido2" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" name="Apellido2" id="Apellido2">
                </div>

                <div class="col-md-4 mt-2">
                    <label for="Pais" class="form-label">País</label>
                    <input type="text" class="form-control" name="Pais" id="Pais" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="Telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="Telefono" id="Telefono" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="Ciudad" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="Ciudad" id="Ciudad" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar clientes -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Apellido2</th>
                    <th>País</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'ClientesController.php';
                $controller = new ClientesController();
                $clientes = $controller->getAll();

                foreach ($clientes as $cliente) {
                    echo "<tr>
                        <td>{$cliente['ID_Cliente']}</td>
                        <td>{$cliente['Nombre']}</td>
                        <td>{$cliente['Apellido1']}</td>
                        <td>{$cliente['Apellido2']}</td>
                        <td>{$cliente['Pais']}</td>
                        <td>{$cliente['Telefono']}</td>
                        <td>{$cliente['Ciudad']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarCliente(" . json_encode($cliente) . ")'>Editar</button>
                            <a href='ClientesController.php?accion=eliminar&ID_Cliente={$cliente['ID_Cliente']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarCliente(cliente) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Cliente').value = cliente.ID_Cliente;
            document.getElementById('Nombre').value = cliente.Nombre;
            document.getElementById('Apellido1').value = cliente.Apellido1;
            document.getElementById('Apellido2').value = cliente.Apellido2;
            document.getElementById('Pais').value = cliente.Pais;
            document.getElementById('Telefono').value = cliente.Telefono;
            document.getElementById('Ciudad').value = cliente.Ciudad;
        }
    </script>
</body>
</html>

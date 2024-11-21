<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Opiniones de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Opiniones de Clientes</h1>

        <!-- Formulario para agregar/editar opinión -->
        <form id="formOpinion" method="POST" action="OpinionController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambiar a "editar" si es necesario -->
                <input type="hidden" name="ID_Opinion" id="ID_Opinion"> <!-- ID para editar -->

                <div class="col-md-6">
                    <label for="Fecha_Opinion" class="form-label">Fecha de Opinión</label>
                    <input type="date" class="form-control" name="Fecha_Opinion" id="Fecha_Opinion" required>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="Calificacion" class="form-label">Calificación</label>
                    <input type="number" class="form-control" name="Calificacion" id="Calificacion" min="1" max="5" required>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="Comentarios" class="form-label">Comentarios</label>
                    <textarea class="form-control" name="Comentarios" id="Comentarios" rows="4" required></textarea>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="ID_Cliente" class="form-label">ID Cliente</label>
                    <input type="number" class="form-control" name="ID_Cliente" id="ID_Cliente" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar las opiniones -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Opinión</th>
                    <th>Fecha de Opinión</th>
                    <th>Calificación</th>
                    <th>Comentarios</th>
                    <th>ID Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'OpinionController.php';
                $controller = new OpinionController();
                $opiniones = $controller->getAll();

                foreach ($opiniones as $opinion) {
                    echo "<tr>
                        <td>{$opinion['ID_Opinion']}</td>
                        <td>{$opinion['Fecha_Opinion']}</td>
                        <td>{$opinion['Calificacion']}</td>
                        <td>{$opinion['Comentarios']}</td>
                        <td>{$opinion['ID_Cliente']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarOpinion(" . json_encode($opinion) . ")'>Editar</button>
                            <a href='OpinionController.php?accion=eliminar&ID_Opinion={$opinion['ID_Opinion']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarOpinion(opinion) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Opinion').value = opinion.ID_Opinion;
            document.getElementById('Fecha_Opinion').value = opinion.Fecha_Opinion;
            document.getElementById('Calificacion').value = opinion.Calificacion;
            document.getElementById('Comentarios').value = opinion.Comentarios;
            document.getElementById('ID_Cliente').value = opinion.ID_Cliente;
        }
    </script>
</body>
</html>

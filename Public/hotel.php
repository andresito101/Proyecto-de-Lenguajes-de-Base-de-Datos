<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Hoteles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Hoteles</h1>

        <!-- Formulario para agregar/editar un hotel -->
        <form id="formHoteles" method="POST" action="HotelesController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambia a "editar" si es necesario -->
                <input type="hidden" name="ID_Hotel" id="ID_Hotel"> <!-- ID para editar -->

                <div class="col-md-4">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                </div>

                <div class="col-md-4">
                    <label for="Ciudad" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="Ciudad" id="Ciudad" required>
                </div>

                <div class="col-md-4">
                    <label for="Pais" class="form-label">País</label>
                    <input type="text" class="form-control" name="Pais" id="Pais" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="CantidadEstrellas" class="form-label">Cantidad de Estrellas</label>
                    <input type="number" class="form-control" name="CantidadEstrellas" id="CantidadEstrellas" min="1" max="5" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="Telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="Telefono" id="Telefono" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar hoteles -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>País</th>
                    <th>Cantidad de Estrellas</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'HotelesController.php';
                $controller = new HotelesController();
                $hoteles = $controller->getAll();

                foreach ($hoteles as $hotel) {
                    echo "<tr>
                        <td>{$hotel['ID_Hotel']}</td>
                        <td>{$hotel['Nombre']}</td>
                        <td>{$hotel['Ciudad']}</td>
                        <td>{$hotel['Pais']}</td>
                        <td>{$hotel['CantidadEstrellas']}</td>
                        <td>{$hotel['Telefono']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarHotel(" . json_encode($hotel) . ")'>Editar</button>
                            <a href='HotelesController.php?accion=eliminar&ID_Hotel={$hotel['ID_Hotel']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarHotel(hotel) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Hotel').value = hotel.ID_Hotel;
            document.getElementById('Nombre').value = hotel.Nombre;
            document.getElementById('Ciudad').value = hotel.Ciudad;
            document.getElementById('Pais').value = hotel.Pais;
            document.getElementById('CantidadEstrellas').value = hotel.CantidadEstrellas;
            document.getElementById('Telefono').value = hotel.Telefono;
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Restaurantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Restaurantes</h1>

        <!-- Formulario para agregar/editar un restaurante -->
        <form id="formRestaurantes" method="POST" action="RestaurantesController.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="crear"> <!-- Cambia a "editar" si es necesario -->
                <input type="hidden" name="ID_Restaurante" id="ID_Restaurante"> <!-- ID para editar -->

                <div class="col-md-4">
                    <label for="ID_Hotel" class="form-label">Hotel</label>
                    <select name="ID_Hotel" id="ID_Hotel" class="form-select" required>
                        <option value="">Seleccionar Hotel</option>
                        <?php
                        require_once 'HotelesController.php';
                        $hotelesController = new HotelesController();
                        $hoteles = $hotelesController->getAll();

                        foreach ($hoteles as $hotel) {
                            echo "<option value='{$hotel['ID_Hotel']}'>{$hotel['Nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="Nombre" class="form-label">Nombre del Restaurante</label>
                    <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                </div>

                <div class="col-md-4">
                    <label for="TipoDeComida" class="form-label">Tipo de Comida</label>
                    <input type="text" class="form-control" name="TipoDeComida" id="TipoDeComida" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="HoraApertura" class="form-label">Hora de Apertura</label>
                    <input type="time" class="form-control" name="HoraApertura" id="HoraApertura" required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="HoraCierre" class="form-label">Hora de Cierre</label>
                    <input type="time" class="form-control" name="HoraCierre" id="HoraCierre" required>
                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Tabla para listar restaurantes -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hotel</th>
                    <th>Nombre</th>
                    <th>Tipo de Comida</th>
                    <th>Hora Apertura</th>
                    <th>Hora Cierre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'RestaurantesController.php';
                $controller = new RestaurantesController();
                $restaurantes = $controller->getAll();

                foreach ($restaurantes as $restaurante) {
                    echo "<tr>
                        <td>{$restaurante['ID_Restaurante']}</td>
                        <td>{$restaurante['ID_Hotel']}</td>
                        <td>{$restaurante['Nombre']}</td>
                        <td>{$restaurante['TipoDeComida']}</td>
                        <td>{$restaurante['HoraApertura']}</td>
                        <td>{$restaurante['HoraCierre']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='editarRestaurante(" . json_encode($restaurante) . ")'>Editar</button>
                            <a href='RestaurantesController.php?accion=eliminar&ID_Restaurante={$restaurante['ID_Restaurante']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarRestaurante(restaurante) {
            document.getElementById('accion').value = 'editar';
            document.getElementById('ID_Restaurante').value = restaurante.ID_Restaurante;
            document.getElementById('ID_Hotel').value = restaurante.ID_Hotel;
            document.getElementById('Nombre').value = restaurante.Nombre;
            document.getElementById('TipoDeComida').value = restaurante.TipoDeComida;
            document.getElementById('HoraApertura').value = restaurante.HoraApertura;
            document.getElementById('HoraCierre').value = restaurante.HoraCierre;
        }
    </script>
</body>
</html>

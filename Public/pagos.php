<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Pagos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.html">Hotel Buena Vista</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="gestion-clientes.html">Gestión de Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="checkin-checkout.html">Check-In/Check-Out</a></li>
            <li class="nav-item"><a class="nav-link" href="reservaciones.html">Reservaciones</a></li>
            <li class="nav-item"><a class="nav-link" href="pagos.html">Pagos</a></li>
            <li class="nav-item"><a class="nav-link" href="retroalimentacion.html">Retroalimentación</a></li>
            <li class="nav-item"><a class="nav-link" href="gestion-servicios.html">Gestión de Servicios</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="text-center">Gestión de Pagos</h1>
    <p class="text-center">Administra los pagos realizados por los clientes.</p>

    <!-- Formulario para Registrar Pagos -->
    <section class="my-5">
      <h2>Registrar Nuevo Pago</h2>
      <form id="form-pagos">
        <div class="mb-3">
          <label for="id-reservacion" class="form-label">ID de Reservación</label>
          <input type="text" id="id-reservacion" class="form-control" placeholder="ID de la reservación" required>
        </div>
        <div class="mb-3">
          <label for="monto" class="form-label">Monto</label>
          <input type="number" id="monto" class="form-control" placeholder="Monto pagado" required>
        </div>
        <div class="mb-3">
          <label for="metodoPago" class="form-label">Método de Pago</label>
          <select id="metodoPago" class="form-control" required>
            <option value="" selected disabled>Selecciona un método</option>
            <option value="tarjeta">Tarjeta de Crédito</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia Bancaria</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Pago</button>
      </form>
    </section>

    <!-- Tabla de Pagos -->
    <section class="my-5">
      <h2>Pagos Realizados</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>ID Reservación</th>
            <th>Monto</th>
            <th>Método de Pago</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ejemplo de datos -->
          <tr>
            <td>1</td>
            <td>12345</td>
            <td>$250</td>
            <td>Tarjeta de Crédito</td>
            <td>2024-11-20</td>
            <td>
              <button class="btn btn-warning btn-sm">Editar</button>
              <button class="btn btn-danger btn-sm">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/app.js"></script>
</body>
</html>

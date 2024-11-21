<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Reservaciones</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Barra de navegación -->
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
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="text-center">Gestión de Reservaciones</h1>
    <p class="text-center">Administra las reservaciones de los clientes de forma rápida y sencilla.</p>

    <!-- Formulario para Crear Reservación -->
    <section class="my-5">
      <h2>Crear Nueva Reservación</h2>
      <form id="form-reservacion">
        <div class="mb-3">
          <label for="cliente" class="form-label">Cliente</label>
          <input type="text" id="cliente" class="form-control" placeholder="Nombre del cliente" required>
        </div>
        <div class="mb-3">
          <label for="habitacion" class="form-label">Número de Habitación</label>
          <input type="text" id="habitacion" class="form-control" placeholder="Ejemplo: 101" required>
        </div>
        <div class="mb-3">
          <label for="fechaEntrada" class="form-label">Fecha de Entrada</label>
          <input type="date" id="fechaEntrada" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="fechaSalida" class="form-label">Fecha de Salida</label>
          <input type="date" id="fechaSalida" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Reservación</button>
      </form>
    </section>

    <!-- Tabla de Reservaciones -->
    <section class="my-5">
      <h2>Reservaciones Existentes</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Habitación</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ejemplo de datos -->
          <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>101</td>
            <td>2024-11-20</td>
            <td>2024-11-25</td>
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

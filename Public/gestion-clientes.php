<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Clientes</title>
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
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h1 class="text-center">Gestión de Clientes</h1>

    <!-- Registro de nuevos clientes -->
    <section class="my-5">
      <h2>Registrar Nuevo Cliente</h2>
      <form id="form-registrar">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" placeholder="Nombre del cliente" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" placeholder="Correo electrónico del cliente" required>
        </div>
        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" class="form-control" id="telefono" placeholder="Número de teléfono" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
    </section>

    <!-- Búsqueda y listado de clientes -->
    <section class="my-5">
      <h2>Buscar Clientes</h2>
      <div class="input-group mb-3">
        <input type="text" id="busqueda" class="form-control" placeholder="Buscar por nombre o correo">
        <button class="btn btn-outline-secondary" id="btn-buscar">Buscar</button>
      </div>

      <h3 class="mt-4">Listado de Clientes</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="lista-clientes">
          <!-- Filas dinámicas -->
        </tbody>
      </table>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/app.js"></script>
</body>
</html>
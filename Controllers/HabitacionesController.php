<?php
require_once 'HabitacionesModel.php';

class HabitacionesController {
    private $model;

    public function __construct() {
        $this->model = new HabitacionesModel();
    }

    // Obtener todas las habitaciones
    public function getAll() {
        return $this->model->getAll();
    }

    // Obtener una habitación específica
    public function getById($id) {
        return $this->model->getById($id);
    }

    // Crear una nueva habitación
    public function create($idHotel, $tipo, $precio) {
        return $this->model->create($idHotel, $tipo, $precio);
    }

    // Actualizar una habitación
    public function update($id, $idHotel, $tipo, $precio) {
        return $this->model->update($id, $idHotel, $tipo, $precio);
    }

    // Eliminar una habitación
    public function delete($id) {
        return $this->model->delete($id);
    }
}

// Ejemplo de uso
$controller = new HabitacionesController();
// Crear una habitación
$controller->create(1, 'Suite', 1000);
// Obtener habitaciones
print_r($controller->getAll());
?>

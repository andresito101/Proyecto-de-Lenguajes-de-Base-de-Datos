<?php
require_once 'ClienteHabitacionModel.php';

class ClienteHabitacionController {
    private $model;

    public function __construct() {
        $this->model = new ClienteHabitacionModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Cliente' => $_POST['ID_Cliente'],
                'Num_Habitacion' => $_POST['Num_Habitacion'],
                'Fecha_Entrada' => $_POST['Fecha_Entrada'],
                'Fecha_Salida' => $_POST['Fecha_Salida']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Cliente' => $_POST['ID_Cliente'],
                'Num_Habitacion' => $_POST['Num_Habitacion'],
                'Fecha_Entrada' => $_POST['Fecha_Entrada'],
                'Fecha_Salida' => $_POST['Fecha_Salida']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idCliente = $_GET['ID_Cliente'];
            $numHabitacion = $_GET['Num_Habitacion'];
            $this->model->delete($idCliente, $numHabitacion);
        }
        header('Location: cliente_habitacion.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new ClienteHabitacionController();
    $controller->handleRequest();
}

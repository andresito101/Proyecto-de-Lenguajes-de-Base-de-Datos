<?php
require_once 'ReservacionesClienteModel.php';

class ReservacionesClienteController {
    private $model;

    public function __construct() {
        $this->model = new ReservacionesClienteModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Cliente' => $_POST['ID_Cliente'],
                'Fecha' => $_POST['Fecha'],
                'Estado' => $_POST['Estado']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Reservacion' => $_POST['ID_Reservacion'],
                'ID_Cliente' => $_POST['ID_Cliente'],
                'Fecha' => $_POST['Fecha'],
                'Estado' => $_POST['Estado']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $id = $_GET['ID_Reservacion'];
            $this->model->delete($id);
        }
        header('Location: reservaciones_cliente.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['accion'])) {
    $controller = new ReservacionesClienteController();
    $controller->handleRequest();
}

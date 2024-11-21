<?php
require_once 'RegistroServicioModel.php';

class RegistroServicioController {
    private $model;

    public function __construct() {
        $this->model = new RegistroServicioModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Registro' => $_POST['ID_Registro'],
                'Estado' => $_POST['Estado']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Servicio' => $_POST['ID_Servicio'],
                'ID_Registro' => $_POST['ID_Registro'],
                'Estado' => $_POST['Estado']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idServicio = $_GET['ID_Servicio'];
            $this->model->delete($idServicio);
        }
        header('Location: registro_servicio.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new RegistroServicioController();
    $controller->handleRequest();
}

<?php
require_once 'SuministrosModel.php';

class SuministrosController {
    private $model;

    public function __construct() {
        $this->model = new SuministrosModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'Descripcion' => $_POST['Descripcion'],
                'Fecha_Recepcion' => $_POST['Fecha_Recepcion'],
                'Estado' => $_POST['Estado'],
                'Empresa' => $_POST['Empresa']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Suministro' => $_POST['ID_Suministro'],
                'Descripcion' => $_POST['Descripcion'],
                'Fecha_Recepcion' => $_POST['Fecha_Recepcion'],
                'Estado' => $_POST['Estado'],
                'Empresa' => $_POST['Empresa']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idSuministro = $_GET['ID_Suministro'];
            $this->model->delete($idSuministro);
        }
        header('Location: suministros.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new SuministrosController();
    $controller->handleRequest();
}

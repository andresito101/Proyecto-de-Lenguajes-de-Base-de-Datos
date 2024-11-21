<?php
require_once 'ClienteModel.php';

class ClientesController {
    private $model;

    public function __construct() {
        $this->model = new ClienteModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'Nombre' => $_POST['Nombre'],
                'Apellido1' => $_POST['Apellido1'],
                'Apellido2' => $_POST['Apellido2'],
                'Pais' => $_POST['Pais'],
                'Telefono' => $_POST['Telefono'],
                'Ciudad' => $_POST['Ciudad']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Cliente' => $_POST['ID_Cliente'],
                'Nombre' => $_POST['Nombre'],
                'Apellido1' => $_POST['Apellido1'],
                'Apellido2' => $_POST['Apellido2'],
                'Pais' => $_POST['Pais'],
                'Telefono' => $_POST['Telefono'],
                'Ciudad' => $_POST['Ciudad']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $id = $_GET['ID_Cliente'];
            $this->model->delete($id);
        }
        header('Location: cliente.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['accion'])) {
    $controller = new ClientesController();
    $controller->handleRequest();
}

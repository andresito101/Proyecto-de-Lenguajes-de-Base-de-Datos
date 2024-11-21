<?php
require_once 'HotelModel.php';

class HotelesController {
    private $model;

    public function __construct() {
        $this->model = new HotelModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'Nombre' => $_POST['Nombre'],
                'Ciudad' => $_POST['Ciudad'],
                'Pais' => $_POST['Pais'],
                'CantidadEstrellas' => $_POST['CantidadEstrellas'],
                'Telefono' => $_POST['Telefono']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Hotel' => $_POST['ID_Hotel'],
                'Nombre' => $_POST['Nombre'],
                'Ciudad' => $_POST['Ciudad'],
                'Pais' => $_POST['Pais'],
                'CantidadEstrellas' => $_POST['CantidadEstrellas'],
                'Telefono' => $_POST['Telefono']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $id = $_GET['ID_Hotel'];
            $this->model->delete($id);
        }
        header('Location: hotel.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['accion'])) {
    $controller = new HotelesController();
    $controller->handleRequest();
}

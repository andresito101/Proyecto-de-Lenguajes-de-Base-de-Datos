<?php
require_once 'RestauranteModel.php';

class RestaurantesController {
    private $model;

    public function __construct() {
        $this->model = new RestauranteModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Hotel' => $_POST['ID_Hotel'],
                'Nombre' => $_POST['Nombre'],
                'TipoDeComida' => $_POST['TipoDeComida'],
                'HoraApertura' => $_POST['HoraApertura'],
                'HoraCierre' => $_POST['HoraCierre']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Restaurante' => $_POST['ID_Restaurante'],
                'ID_Hotel' => $_POST['ID_Hotel'],
                'Nombre' => $_POST['Nombre'],
                'TipoDeComida' => $_POST['TipoDeComida'],
                'HoraApertura' => $_POST['HoraApertura'],
                'HoraCierre' => $_POST['HoraCierre']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $id = $_GET['ID_Restaurante'];
            $this->model->delete($id);
        }
        header('Location: restaurantes.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['accion'])) {
    $controller = new RestaurantesController();
    $controller->handleRequest();
}

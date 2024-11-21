<?php
require_once 'ServicioHotelModel.php';

class ServicioHotelController {
    private $model;

    public function __construct() {
        $this->model = new ServicioHotelModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'Nombre_Servicio' => $_POST['Nombre_Servicio']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Servicio' => $_POST['ID_Servicio'],
                'Nombre_Servicio' => $_POST['Nombre_Servicio']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idServicio = $_GET['ID_Servicio'];
            $this->model->delete($idServicio);
        }
        header('Location: servicio_hotel.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new ServicioHotelController();
    $controller->handleRequest();
}

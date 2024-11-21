<?php
require_once 'OpinionModel.php';

class OpinionController {
    private $model;

    public function __construct() {
        $this->model = new OpinionModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'Fecha_Opinion' => $_POST['Fecha_Opinion'],
                'Calificacion' => $_POST['Calificacion'],
                'Comentarios' => $_POST['Comentarios'],
                'ID_Cliente' => $_POST['ID_Cliente']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Opinion' => $_POST['ID_Opinion'],
                'Fecha_Opinion' => $_POST['Fecha_Opinion'],
                'Calificacion' => $_POST['Calificacion'],
                'Comentarios' => $_POST['Comentarios'],
                'ID_Cliente' => $_POST['ID_Cliente']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idOpinion = $_GET['ID_Opinion'];
            $this->model->delete($idOpinion);
        }
        header('Location: opinion_clientes.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new OpinionController();
    $controller->handleRequest();
}

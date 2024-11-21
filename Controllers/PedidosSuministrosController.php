<?php
require_once 'PedidosSuministrosModel.php';

class PedidosSuministrosController {
    private $model;

    public function __construct() {
        $this->model = new PedidosSuministrosModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Pedido' => $_POST['ID_Pedido'],
                'ID_Suministro' => $_POST['ID_Suministro'],
                'Cantidad' => $_POST['Cantidad']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Pedido' => $_POST['ID_Pedido'],
                'ID_Suministro' => $_POST['ID_Suministro'],
                'Cantidad' => $_POST['Cantidad']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idPedido = $_GET['ID_Pedido'];
            $idSuministro = $_GET['ID_Suministro'];
            $this->model->delete($idPedido, $idSuministro);
        }
        header('Location: pedidos_suministros.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new PedidosSuministrosController();
    $controller->handleRequest();
}

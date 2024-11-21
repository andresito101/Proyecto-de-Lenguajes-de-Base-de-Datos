<?php
require_once 'PedidosModel.php';

class PedidosController {
    private $model;

    public function __construct() {
        $this->model = new PedidosModel();
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function handleRequest() {
        $accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

        if ($accion == 'crear') {
            $data = [
                'ID_Hotel' => $_POST['ID_Hotel'],
                'ID_Suministro' => $_POST['ID_Suministro'],
                'Cantidad' => $_POST['Cantidad'],
                'Fecha_Pedido' => $_POST['Fecha_Pedido']
            ];
            $this->model->create($data);
        } elseif ($accion == 'editar') {
            $data = [
                'ID_Pedido' => $_POST['ID_Pedido'],
                'ID_Hotel' => $_POST['ID_Hotel'],
                'ID_Suministro' => $_POST['ID_Suministro'],
                'Cantidad' => $_POST['Cantidad'],
                'Fecha_Pedido' => $_POST['Fecha_Pedido']
            ];
            $this->model->update($data);
        } elseif ($accion == 'eliminar') {
            $idPedido = $_GET['ID_Pedido'];
            $this->model->delete($idPedido);
        }
        header('Location: pedidos.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['accion'])) {
    $controller = new PedidosController();
    $controller->handleRequest();
}

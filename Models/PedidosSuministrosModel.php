<?php
require_once 'Database.php';

class PedidosSuministrosModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT p.ID_Pedido, s.ID_Suministro, ps.Cantidad
                FROM Pedidos_Suministros ps
                JOIN Pedidos p ON ps.ID_Pedido = p.ID_Pedido
                JOIN Suministros s ON ps.ID_Suministro = s.ID_Suministro";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Pedidos_Suministros (ID_Pedido, ID_Suministro, Cantidad) 
                VALUES (:ID_Pedido, :ID_Suministro, :Cantidad)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Pedidos_Suministros SET 
                Cantidad = :Cantidad 
                WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idPedido, $idSuministro) {
        $sql = "DELETE FROM Pedidos_Suministros WHERE ID_Pedido = :ID_Pedido AND ID_Suministro = :ID_Suministro";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Pedido' => $idPedido, 'ID_Suministro' => $idSuministro]);
    }
}

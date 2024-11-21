<?php
require_once 'Database.php';

class PedidosModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT p.ID_Pedido, h.Nombre AS Hotel, s.Descripcion AS Suministro, p.Cantidad, p.Fecha_Pedido
                FROM Pedidos p
                JOIN Hotel h ON p.ID_Hotel = h.ID_Hotel
                JOIN Suministros s ON p.ID_Suministro = s.ID_Suministro";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Pedidos (ID_Hotel, ID_Suministro, Cantidad, Fecha_Pedido) 
                VALUES (:ID_Hotel, :ID_Suministro, :Cantidad, :Fecha_Pedido)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Pedidos SET 
                ID_Hotel = :ID_Hotel, 
                ID_Suministro = :ID_Suministro, 
                Cantidad = :Cantidad, 
                Fecha_Pedido = :Fecha_Pedido 
                WHERE ID_Pedido = :ID_Pedido";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idPedido) {
        $sql = "DELETE FROM Pedidos WHERE ID_Pedido = :ID_Pedido";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Pedido' => $idPedido]);
    }
}

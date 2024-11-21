<?php
require_once 'Database.php';

class ReservacionesRestaurantesModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Reservaciones_Restaurantes";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Reservaciones_Restaurantes (ID_Restaurante, ID_Cliente, Fecha, Estado) 
                VALUES (:ID_Restaurante, :ID_Cliente, :Fecha, :Estado)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Reservaciones_Restaurantes SET ID_Restaurante = :ID_Restaurante, 
                ID_Cliente = :ID_Cliente, Fecha = :Fecha, Estado = :Estado 
                WHERE ID_Reservacion = :ID_Reservacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM Reservaciones_Restaurantes WHERE ID_Reservacion = :ID_Reservacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Reservacion' => $id]);
    }
}

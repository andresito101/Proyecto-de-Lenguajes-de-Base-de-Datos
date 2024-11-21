<?php
require_once 'Database.php';

class ReservacionesClienteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Reservaciones_Cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Reservaciones_Cliente (ID_Cliente, Fecha, Estado) 
                VALUES (:ID_Cliente, :Fecha, :Estado)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Reservaciones_Cliente SET ID_Cliente = :ID_Cliente, 
                Fecha = :Fecha, Estado = :Estado 
                WHERE ID_Reservacion = :ID_Reservacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM Reservaciones_Cliente WHERE ID_Reservacion = :ID_Reservacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Reservacion' => $id]);
    }
}

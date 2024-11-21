<?php
require_once 'Database.php';

class ServicioHotelModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Servicio_Hotel";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Servicio_Hotel (Nombre_Servicio) VALUES (:Nombre_Servicio)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Servicio_Hotel SET Nombre_Servicio = :Nombre_Servicio WHERE ID_Servicio = :ID_Servicio";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idServicio) {
        $sql = "DELETE FROM Servicio_Hotel WHERE ID_Servicio = :ID_Servicio";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Servicio' => $idServicio]);
    }
}

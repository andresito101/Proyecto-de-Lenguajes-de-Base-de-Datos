<?php
require_once 'Database.php';

class RegistroServicioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Registro_Servicio";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Registro_Servicio (ID_Registro, Estado) 
                VALUES (:ID_Registro, :Estado)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Registro_Servicio SET 
                ID_Registro = :ID_Registro, 
                Estado = :Estado
                WHERE ID_Servicio = :ID_Servicio";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idServicio) {
        $sql = "DELETE FROM Registro_Servicio WHERE ID_Servicio = :ID_Servicio";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Servicio' => $idServicio]);
    }
}

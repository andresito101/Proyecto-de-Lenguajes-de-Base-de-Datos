<?php
require_once 'Database.php';

class SuministrosModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Suministros";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Suministros (Descripcion, Fecha_Recepcion, Estado, Empresa) 
                VALUES (:Descripcion, :Fecha_Recepcion, :Estado, :Empresa)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Suministros SET 
                Descripcion = :Descripcion, 
                Fecha_Recepcion = :Fecha_Recepcion, 
                Estado = :Estado, 
                Empresa = :Empresa
                WHERE ID_Suministro = :ID_Suministro";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idSuministro) {
        $sql = "DELETE FROM Suministros WHERE ID_Suministro = :ID_Suministro";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Suministro' => $idSuministro]);
    }
}

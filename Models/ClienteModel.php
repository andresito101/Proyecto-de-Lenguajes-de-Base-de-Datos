<?php
require_once 'Database.php';

class ClienteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Cliente (Nombre, Apellido1, Apellido2, Pais, Telefono, Ciudad)
                VALUES (:Nombre, :Apellido1, :Apellido2, :Pais, :Telefono, :Ciudad)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Cliente SET Nombre = :Nombre, Apellido1 = :Apellido1, Apellido2 = :Apellido2, Pais = :Pais,
                Telefono = :Telefono, Ciudad = :Ciudad WHERE ID_Cliente = :ID_Cliente";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM Cliente WHERE ID_Cliente = :ID_Cliente";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Cliente' => $id]);
    }
}

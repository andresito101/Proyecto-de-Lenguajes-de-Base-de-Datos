<?php
require_once 'Database.php';

class HotelModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Hotel";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Hotel (Nombre, Ciudad, Pais, CantidadEstrellas, Telefono)
                VALUES (:Nombre, :Ciudad, :Pais, :CantidadEstrellas, :Telefono)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Hotel SET Nombre = :Nombre, Ciudad = :Ciudad, Pais = :Pais, 
                CantidadEstrellas = :CantidadEstrellas, Telefono = :Telefono 
                WHERE ID_Hotel = :ID_Hotel";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM Hotel WHERE ID_Hotel = :ID_Hotel";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Hotel' => $id]);
    }
}

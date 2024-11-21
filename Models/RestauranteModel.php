<?php
require_once 'Database.php';

class RestauranteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Restaurantes";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Restaurantes (ID_Hotel, Nombre, TipoDeComida, HoraApertura, HoraCierre)
                VALUES (:ID_Hotel, :Nombre, :TipoDeComida, :HoraApertura, :HoraCierre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Restaurantes SET ID_Hotel = :ID_Hotel, Nombre = :Nombre, 
                TipoDeComida = :TipoDeComida, HoraApertura = :HoraApertura, HoraCierre = :HoraCierre 
                WHERE ID_Restaurante = :ID_Restaurante";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM Restaurantes WHERE ID_Restaurante = :ID_Restaurante";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Restaurante' => $id]);
    }
}

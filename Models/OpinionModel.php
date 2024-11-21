<?php
require_once 'Database.php';

class OpinionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Opinion_clientes";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Opinion_clientes (Fecha_Opinion, Calificacion, Comentarios, ID_Cliente) 
                VALUES (:Fecha_Opinion, :Calificacion, :Comentarios, :ID_Cliente)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Opinion_clientes SET 
                Fecha_Opinion = :Fecha_Opinion, 
                Calificacion = :Calificacion, 
                Comentarios = :Comentarios, 
                ID_Cliente = :ID_Cliente
                WHERE ID_Opinion = :ID_Opinion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idOpinion) {
        $sql = "DELETE FROM Opinion_clientes WHERE ID_Opinion = :ID_Opinion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Opinion' => $idOpinion]);
    }
}

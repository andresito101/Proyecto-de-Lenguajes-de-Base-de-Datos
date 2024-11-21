<?php
require_once 'Database.php';

class ClienteHabitacionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM Cliente_Habitacion
                JOIN Clientes ON Cliente_Habitacion.ID_Cliente = Clientes.ID_Cliente
                JOIN Habitaciones ON Cliente_Habitacion.Num_Habitacion = Habitaciones.Num_Habitacion";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO Cliente_Habitacion (ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida) 
                VALUES (:ID_Cliente, :Num_Habitacion, :Fecha_Entrada, :Fecha_Salida)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE Cliente_Habitacion SET 
                Fecha_Entrada = :Fecha_Entrada, Fecha_Salida = :Fecha_Salida 
                WHERE ID_Cliente = :ID_Cliente AND Num_Habitacion = :Num_Habitacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($idCliente, $numHabitacion) {
        $sql = "DELETE FROM Cliente_Habitacion WHERE ID_Cliente = :ID_Cliente AND Num_Habitacion = :Num_Habitacion";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['ID_Cliente' => $idCliente, 'Num_Habitacion' => $numHabitacion]);
    }
}

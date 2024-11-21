<?php
require_once 'db.php';

class HabitacionesModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Obtener todas las habitaciones
    public function getAll() {
        $query = "SELECT * FROM Habitaciones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una habitación por ID
    public function getById($id) {
        $query = "SELECT * FROM Habitaciones WHERE Num_Habitacion = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva habitación
    public function create($idHotel, $tipo, $precio) {
        $query = "INSERT INTO Habitaciones (ID_Hotel, Tipo_de_Habitacion, Precio_por_noche) 
                VALUES (:idHotel, :tipo, :precio)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idHotel', $idHotel);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':precio', $precio);
        return $stmt->execute();
    }

    // Actualizar una habitación
    public function update($id, $idHotel, $tipo, $precio) {
        $query = "UPDATE Habitaciones 
                SET ID_Hotel = :idHotel, Tipo_de_Habitacion = :tipo, Precio_por_noche = :precio 
                WHERE Num_Habitacion = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':idHotel', $idHotel);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':precio', $precio);
        return $stmt->execute();
    }

    // Eliminar una habitación
    public function delete($id) {
        $query = "DELETE FROM Habitaciones WHERE Num_Habitacion = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

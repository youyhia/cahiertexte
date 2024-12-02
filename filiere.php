<?php
class Filiere {
    private $conn;
    private $table = 'filieres';

    public $id;
    public $nom;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function creer() {
        $query = "INSERT INTO " . $this->table . " (nom, description) VALUES (:nom, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        return $stmt->execute();
    }

    public function lire() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mettreAJour() {
        $query = "UPDATE " . $this->table . " SET nom = :nom, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function supprimer() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>

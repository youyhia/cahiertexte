<?php
class Groupe {
    private $conn;
    private $table = 'groupes';

    public $id;
    public $nom;
    public $filiere_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function creer() {
        $query = "INSERT INTO " . $this->table . " (nom, filiere_id) VALUES (:nom, :filiere_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':filiere_id', $this->filiere_id);
        return $stmt->execute();
    }

    public function lire() {
        $query = "SELECT g.*, f.nom as filiere_nom FROM " . $this->table . " g JOIN filieres f ON g.filiere_id = f.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimer() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>

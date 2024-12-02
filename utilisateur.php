<?php
class Utilisateur {
    private $conn;
    private $table = 'utilisateurs';

    public $id;
    public $nom;
    public $email;
    public $mot_de_passe;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function inscrire() {
        $query = "INSERT INTO " . $this->table . " (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
        $stmt = $this->conn->prepare($query);

        $this->mot_de_passe = password_hash($this->mot_de_passe, PASSWORD_BCRYPT);

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mot_de_passe', $this->mot_de_passe);

        return $stmt->execute();
    }

    public function connexion() {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur && password_verify($this->mot_de_passe, $utilisateur['mot_de_passe'])) {
            $this->id = $utilisateur['id'];
            $this->nom = $utilisateur['nom'];
            $this->role = $utilisateur['role'];
            return true;
        }
        return false;
    }
}
?>

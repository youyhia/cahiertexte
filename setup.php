<?php
require 'Database.php'; 

$database = new Database();
$conn = $database->getConnection();

try {
    
    $sql = "
        CREATE DATABASE IF NOT EXISTS cahier_texte;
        USE cahier_texte;

        -- Table Filière
        CREATE TABLE IF NOT EXISTS filiere (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(255) NOT NULL,
            description TEXT
        );

        -- Table Groupe
        CREATE TABLE IF NOT EXISTS groupe (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(255) NOT NULL,
            filiere_id INT NOT NULL,
            FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE CASCADE
        );
    ";

    // Exécuter le script SQL
    $conn->exec($sql);
    echo "Base de données et tables créées avec succès !";
} catch (PDOException $exception) {
    echo "Erreur : " . $exception->getMessage();
}
?>

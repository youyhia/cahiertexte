<?php
require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($conn) {
    echo "Connexion réussie !";
} else {
    echo "Connexion échouée.";
}

<?php
require 'Database.php';
require 'Utilisateur.php';

session_start();
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur = new Utilisateur($db);
    $utilisateur->email = $_POST['email'];
    $utilisateur->mot_de_passe = $_POST['mot_de_passe'];

    if ($utilisateur->connexion()) {
        $_SESSION['utilisateur_id'] = $utilisateur->id;
        $_SESSION['utilisateur_nom'] = $utilisateur->nom;
        $_SESSION['role'] = $utilisateur->role;
        header('Location: admin.php');
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

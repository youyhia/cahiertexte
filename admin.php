<?php
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur_nom']); ?></h1>
    <a href="logout.php">Déconnexion</a>
    <h2>Gestion des Filières</h2>
    <a href="filiere.php">Gérer les Filières</a>
    <h2>Gestion des Groupes</h2>
    <a href="groupe.php">Gérer les Groupes</a>
</body>
</html>

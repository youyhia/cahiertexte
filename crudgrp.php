<?php
require 'Database.php';
require 'Groupe.php';
require 'Filiere.php';

$database = new Database();
$db = $database->getConnection();
$groupe = new Groupe($db);
$filiere = new Filiere($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $groupe->nom = $_POST['nom'];
        $groupe->filiere_id = $_POST['filiere_id'];
        $groupe->creer();
    } elseif (isset($_POST['supprimer'])) {
        $groupe->id = $_POST['id'];
        $groupe->supprimer();
    }
}

$groupeListe = $groupe->lire();
$filiereListe = $filiere->lire();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Groupes</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Gestion des Groupes</h1>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom du groupe" required>
        <select name="filiere_id" required>
            <option value="">Choisir une filière</option>
            <?php foreach ($filiereListe as $f) : ?>
            <option value="<?= $f['id']; ?>"><?= htmlspecialchars($f['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupeListe as $g) : ?>
            <tr>
                <td><?= $g['id']; ?></td>
                <td><?= htmlspecialchars($g['nom']); ?></td>
                <td><?= htmlspecialchars($g['filiere_nom']); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $g['id']; ?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

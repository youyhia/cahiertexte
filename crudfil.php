<?php
require 'Database.php';
require 'Filiere.php';

$database = new Database();
$db = $database->getConnection();
$filiere = new Filiere($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $filiere->nom = $_POST['nom'];
        $filiere->description = $_POST['description'];
        $filiere->creer();
    } elseif (isset($_POST['supprimer'])) {
        $filiere->id = $_POST['id'];
        $filiere->supprimer();
    }
}

$filiereListe = $filiere->lire();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Filières</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Gestion des Filières</h1>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom de la filière" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filiereListe as $f) : ?>
            <tr>
                <td><?= $f['id']; ?></td>
                <td><?= htmlspecialchars($f['nom']); ?></td>
                <td><?= htmlspecialchars($f['description']); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $f['id']; ?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

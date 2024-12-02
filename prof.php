<?php
require_once 'database.php';

$db = (new Database())->connect();

// Ajouter un professeur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_prof'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    if ($nom && $email) {
        $stmt = $db->prepare("INSERT INTO professeur (nom, email) VALUES (:nom, :email)");
        $stmt->execute(['nom' => $nom, 'email' => $email]);
        header('Location: professeur.php?message=Professeur ajouté');
        exit;
    }
}

// Supprimer un professeur
if (isset($_GET['delete_id'])) {
    $stmt = $db->prepare("DELETE FROM professeur WHERE id = :id");
    $stmt->execute(['id' => $_GET['delete_id']]);
    header('Location: professeur.php?message=Professeur supprimé');
    exit;
}

// Récupérer tous les professeurs
$professeurs = $db->query("SELECT * FROM professeur")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Professeurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des Professeurs</h1>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <button type="submit" name="add_prof">Ajouter Professeur</button>
    </form>

    <h2>Liste des Professeurs</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professeurs as $prof): ?>
                <tr>
                    <td><?php echo htmlspecialchars($prof['nom']); ?></td>
                    <td><?php echo htmlspecialchars($prof['email']); ?></td>
                    <td>
                        <a href="professeur.php?delete_id=<?php echo $prof['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin.php">Retour</a>
</body>
</html>

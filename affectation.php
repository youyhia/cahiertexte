<?php
require_once 'database.php';

$db = (new Database())->connect();

// Récupérer les groupes et les professeurs
$groupes = $db->query("SELECT * FROM groupe")->fetchAll(PDO::FETCH_ASSOC);
$professeurs = $db->query("SELECT * FROM professeur")->fetchAll(PDO::FETCH_ASSOC);

// Ajouter une séance
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $contenu = $_POST['contenu'];
    $description = $_POST['description'];
    $professeur_id = $_POST['professeur_id'];
    $groupe_id = $_POST['groupe_id'];

    if ($date && $contenu && $professeur_id && $groupe_id) {
        $stmt = $db->prepare("INSERT INTO seance (date_seance, contenu, description, professeur_id, groupe_id) 
                              VALUES (:date, :contenu, :description, :professeur_id, :groupe_id)");
        $stmt->execute([
            'date' => $date,
            'contenu' => $contenu,
            'description' => $description,
            'professeur_id' => $professeur_id,
            'groupe_id' => $groupe_id
        ]);
        header('Location: affectation.php?message=Séance ajoutée');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affecter une Séance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Affecter une Séance</h1>

    <form method="POST">
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>

        <label for="contenu">Contenu :</label>
        <textarea id="contenu" name="contenu" rows="4" required></textarea>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <label for="professeur_id">Professeur :</label>
        <select id="professeur_id" name="professeur_id" required>
            <option value="">--Sélectionner un professeur--</option>
            <?php foreach ($professeurs as $prof): ?>
                <option value="<?php echo $prof['id']; ?>"><?php echo htmlspecialchars($prof['nom']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="groupe_id">Groupe :</label>
        <select id="groupe_id" name="groupe_id" required>
            <option value="">--Sélectionner un groupe--</option>
            <?php foreach ($groupes as $groupe): ?>
                <option value="<?php echo $groupe['id']; ?>"><?php echo htmlspecialchars($groupe['nom']); ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Affecter Séance</button>
    </form>

    <a href="admin.php">Retour</a>
</body>
</html>

<?php
// Déclaration d'une liste énumérée (tableau associatif)
$titres = [
    ["id" => 1, "titre" => "Themes"],
    ["id" => 2, "titre" => "Dossiers"],
    ["id" => 3, "titre" => "Documents"],
    ["id" => 4, "titre" => "Utilisateurs"],
    ["id" => 4, "titre" => "Emprunts"],
   
];

$searchResult = null;
$searchMade   = false;

// Vérifier si l'utilisateur a fait une recherche
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $searchMade = true;
    $search = trim($_POST['search']);

    // Rechercher dans le tableau
    foreach ($roles as $row) {
        if (strcasecmp($row['role'], $search) === 0) { // insensible à la casse
            $searchResult = $row;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste énumérée PHP</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background: #f0f0f0; }
        .notfound { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Recherche d'un rôle</h2>
<form method="post">
    <input type="text" name="search" placeholder="Ex: admin, user..." required>
    <button type="submit">Chercher</button>
</form>

<?php
// Cas 1 : si recherche effectuée et résultat trouvé
if ($searchResult) {
   
    echo $searchResult['id'].ucfirst($searchResult['role']) . $searchResult['description'];
}
// Cas 2 : si recherche effectuée mais rien trouvé → afficher tout le tableau
elseif ($searchMade) {
    echo "<p class='notfound'>Aucun rôle trouvé, affichage de toute la liste :</p>";
    echo "<table>
            <tr><th>ID</th><th>Rôle</th><th>Description</th></tr>";
    foreach ($roles as $r) {
        echo "<tr>
                <td>{$r['id']}</td>
                <td>" . ucfirst($r['role']) . "</td>
                <td>{$r['description']}</td>
              </tr>";
    }
    echo "</table>";
}
// Cas 3 : première visite → afficher tout le tableau par défaut
else {
    echo "<h3>Liste complète des rôles :</h3>";
    echo "<table>
            <tr><th>ID</th><th>Rôle</th><th>Description</th></tr>";
    foreach ($roles as $r) {
        echo "<tr>
                <td>{$r['id']}</td>
                <td>" . ucfirst($r['role']) . "</td>
                <td>{$r['description']}</td>
              </tr>";
    }
    echo "</table>";
}
?>

</body>
</html>

<?php
// Database connection
include '../../connectdb.php';

$sql = "SELECT id, titre_dossier, id_theme FROM dossier";
$result = mysqli_query($conn, $sql);
?>

<form action="insert.php" method="post">
    <label for="titre">titre:</label>
    <input type="text" name="titre" required>

    
    <label for="date_edition">date d'edition:</label>
    <input type="date" name="date_edition" required>

   

    <label for="id_dossier">dossier:</label>
    <select name="id_dossier" required>
        <option value="">-- Select dossier --</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['titre_dossier'] . "</option>";
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Save">
</form>

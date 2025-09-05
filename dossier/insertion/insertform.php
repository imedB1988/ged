<?php
// Database connection
include '../../connectdb.php';

$sql = "SELECT id, designation FROM theme";
$result = mysqli_query($conn, $sql);
?>

<form action="insert.php" method="post">
    <label for="titre_dossier">titre_dossier:</label>
    <input type="text" name="titre_dossier" required>

   

    <label for="id_theme">Role:</label>
    <select name="id_theme" required>
        <option value="">-- Select role --</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['designation'] . "</option>";
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Save">
</form>

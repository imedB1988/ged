<?php
// Database connection
include '../../connectdb.php';

$sql = "SELECT id, nom_role FROM role";
$result = mysqli_query($conn, $sql);
?>

<form action="insert.php" method="post">
    <label for="nom">nom:</label>
    <input type="text" name="nom" required>

    <label for="prenom">prenom:</label>
    <input type="text" name="prenom" required>


    <label for="username">username:</label>
    <input type="text" name="username" required>

     <label for="password">Password:</label>
    <input type="text" name="password" required>

    <label for="id_role">Role:</label>
    <select name="id_role" required>
        <option value="">-- Select role --</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nom_role'] . "</option>";
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Save">
</form>

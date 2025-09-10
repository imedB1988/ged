<?php include "../../connectdb.php"; ?>

<?php
$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM document WHERE id=$id"));

if (!$user) {
    die("Product not found!");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['titre'];
    $dateedition = $_POST['date_edition'];
    $iddossier = $_POST['id_dossier'];
    mysqli_query($conn, "UPDATE document SET titre='$name', date_edition='$dateedition', id_dossier='$iddossier' WHERE id=$id");
}




?>

<h2>Edit Product</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="titre" value="<?= $user['titre'] ?>" required>
    <input type="date" name="date_edition" value="<?= $user['date_edition'] ?>" required>
    <select name="id_dossier" required>
        <?php
        $cats = mysqli_query($conn, "SELECT * FROM dossier");
        while ($row = mysqli_fetch_assoc($cats)) {
            $selected = ($row['id'] == $product['id_dossier']) ? "selected" : "";
            echo "<option value='{$row['id']}' $selected>{$row['titre_dossier']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="update">Update</button>
</form>

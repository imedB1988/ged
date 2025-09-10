<?php include "../../connectdb.php"; ?>

<?php
$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM dossier WHERE id=$id"));

if (!$user) {
    die("Product not found!");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['titre_dossier'];
    $idrole = $_POST['id_theme'];
    mysqli_query($conn, "UPDATE dossier SET titre_dossier='$name', id_theme='$idrole' WHERE id=$id");
}




?>

<h2>Edit Product</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="titre_dossier" value="<?= $user['titre_dossier'] ?>" required>
    <select name="id_theme" required>
        <?php
        $cats = mysqli_query($conn, "SELECT * FROM theme");
        while ($row = mysqli_fetch_assoc($cats)) {
            $selected = ($row['id'] == $product['id_theme']) ? "selected" : "";
            echo "<option value='{$row['id']}' $selected>{$row['designation']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="update">Update</button>
</form>

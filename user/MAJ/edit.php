<?php include "../../connectdb.php"; ?>

<?php
$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id=$id"));

if (!$user) {
    die("Product not found!");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['nom'];
    $idrole = $_POST['id_role'];
    mysqli_query($conn, "UPDATE user SET nom='$name', id_role='$idrole' WHERE id=$id");
}




?>

<h2>Edit Product</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="nom" value="<?= $user['nom'] ?>" required>
    <select name="id_role" required>
        <?php
        $cats = mysqli_query($conn, "SELECT * FROM role");
        while ($row = mysqli_fetch_assoc($cats)) {
            $selected = ($row['id'] == $product['id_role']) ? "selected" : "";
            echo "<option value='{$row['id']}' $selected>{$row['nom_role']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="update">Update</button>
</form>

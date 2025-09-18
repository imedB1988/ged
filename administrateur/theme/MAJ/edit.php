<?php include "../../../connectdb.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM theme WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<form method="POST">
    Name: <input type="text" name="designation" value="<?= $user['designation'] ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>
<a href="../theme/affichage.php">Back</a>

<?php
if (isset($_POST['update'])) {
    $name  = $_POST['designation'];
   
    $sql = "UPDATE theme SET designation='$name' WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: ../affichage.php");
}
?>
</body>
</html>

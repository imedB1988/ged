<?php
$conn = mysqli_connect("localhost", "root", "", "ged");

if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $name  = $_POST['designation'];
  

    $query = "UPDATE theme SET designation='$name' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../affichage.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

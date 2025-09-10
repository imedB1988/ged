<?php
include('../../connectdb.php');
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM document WHERE id=$id");
header("Location: ../affichage.php");
exit;
?>

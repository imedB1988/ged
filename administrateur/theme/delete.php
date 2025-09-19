<?php
include "../../connectdb.php";

if(isset($_POST['deleteBtn'])){
    $id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $sql = "DELETE FROM theme WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("Location: index.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

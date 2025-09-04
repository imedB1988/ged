<?php
include '../../connectdb.php';
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // convert to int for security

    // 3. Delete query
    $sql = "DELETE FROM theme WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID provided!";
}
?>

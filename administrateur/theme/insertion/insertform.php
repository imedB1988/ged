<?php
// Database connection
include '../../../connectdb.php';

$sql = "SELECT id, designation FROM theme";
$result = mysqli_query($conn, $sql);
?>

<form action="insert.php" method="post">
    <label for="designation">nom:</label>
    <input type="text" name="designation" required>

    

    <input type="submit" name="submit" value="Save">
</form>

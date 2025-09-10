<?php
session_start();
include '../connectdb.php';

if (isset($_POST['reset'])) {
    $username    = $_POST['username'];
    $newpassword = $_POST['newpassword'];

    // Check if username exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) == 1) {
        // Update password (no hash)
        $sql = "UPDATE users SET password='$newpassword' WHERE username='$username'";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../loginsystem/connect.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Username not found!";
    }
}
?>


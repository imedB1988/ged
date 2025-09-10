<?php
include "../connectdb.php"; // database connection

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // hash for simplicity

    // Role not asked, always "user"
    $role = "user";

    $sql = "INSERT INTO users (username, email, password, role)
            VALUES ('$username', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
         header("Location: ../loginsystem/connect.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

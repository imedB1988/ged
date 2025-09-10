<?php
session_start();
include '../connectdb.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // no hash

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: ../dashboard/admin_dashboard.php");
        } else {
            header("Location: ../dashboard/user_dashboard.php");
        }
    } else {
        echo "Invalid username or password!";
    }
}
?>

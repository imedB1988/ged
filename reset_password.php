<?php
session_start();
include 'db.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE reset_token='$token' AND token_expire > NOW()";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        die("Invalid or expired token!");
    }

    if(isset($_POST['reset'])){
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$new_password', reset_token=NULL, token_expire=NULL WHERE reset_token='$token'";
        if(mysqli_query($conn, $sql)){
            echo "Password updated successfully!";
        }
    }
}
?>

<form method="post">
    New Password: <input type="password" name="password" required><br>
    <input type="submit" name="reset" value="Reset Password">
</form>

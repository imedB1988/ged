<?php
session_start();
include 'db.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = bin2hex(random_bytes(50));
    $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $sql = "UPDATE users SET reset_token='$token', token_expire='$expire' WHERE email='$email'";
    if(mysqli_query($conn, $sql)){
        $reset_link = "http://localhost/reset_password.php?token=$token";
        echo "Password reset link: <a href='$reset_link'>$reset_link</a>";
        // Normally you would email the link instead of echoing it
    } else {
        echo "Email not found!";
    }
}
?>

<form method="post">
    Enter your email: <input type="email" name="email" required><br>
    <input type="submit" name="submit" value="Send Reset Link">
</form>

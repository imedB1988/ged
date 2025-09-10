<?php
include 'connectdb.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // no hash
    $role     = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="text" name="password" required><br>
    Role: 
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" name="register" value="Register">
</form>



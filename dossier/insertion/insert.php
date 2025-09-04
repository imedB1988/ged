<?php
    include '../../connectdb.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_role = $_POST['id_role'];

    $insert = "INSERT INTO user (nom, prenom, username, password, id_role) VALUES ('$nom', '$prenom', '$username', '$password','$id_role')";
    if (mysqli_query($conn, $insert)) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
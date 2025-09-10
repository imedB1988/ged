<?php
    include '../../connectdb.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['titre_dossier'];
    $id_theme = $_POST['id_theme'];
   

    $insert = "INSERT INTO dossier (titre_dossier, id_theme) VALUES ('$nom','$id_theme')";
    if (mysqli_query($conn, $insert)) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
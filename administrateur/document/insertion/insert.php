<?php
    include '../../connectdb.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['titre'];
    $date_edition = $_POST['date_edition'];
    $available = $_POST['available'];
    $id_dossier = $_POST['id_dossier'];
   

    $insert = "INSERT INTO documents (titre, date_edition,available, id_dossier) VALUES ('$nom','$date_edition','$available','$id_dossier')";
    if (mysqli_query($conn, $insert)) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
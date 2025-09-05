<?php
    include '../../connectdb.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['titre'];
    $date_edition = $_POST['date_edition'];
    $id_dossier = $_POST['id_dossier'];
   

    $insert = "INSERT INTO document (titre, date_edition, id_dossier) VALUES ('$nom','$date_edition','$id_dossier')";
    if (mysqli_query($conn, $insert)) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
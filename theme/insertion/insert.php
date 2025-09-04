<?php
    include '../../connectdb.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['designation'];
    

    $insert = "INSERT INTO theme (designation) VALUES ('$nom')";
    if (mysqli_query($conn, $insert)) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
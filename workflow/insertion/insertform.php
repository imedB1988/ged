<?php
$conn = mysqli_connect("localhost", "root", "", "ged");

if (isset($_POST['borrow'])) {
    $user_id = $_POST['id_user'];
    $book_id = $_POST['id_document'];
    $date_emprunt = date("Y-m-d");
    $date_retour = date("Y-m-d");

    // Insert borrow record
    $sql = "INSERT INTO workflow (id_user, id_document, date_emprunt, date_retour) 
            VALUES ('$user_id', '$book_id', '$date_emprunt', '$date_retour')";

    if (mysqli_query($conn, $sql)) {
        // Mark book as unavailable
        mysqli_query($conn, "UPDATE document SET disponible=0 WHERE id='$book_id'");
        echo "Book borrowed successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="post">
    User ID: <input type="number" name="id_user" required><br>
    Book ID: <input type="number" name="id_document" required><br>
    <button type="submit" name="borrow">Borrow Book</button>
</form>

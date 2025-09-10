<?php
$conn = mysqli_connect("localhost", "root", "", "ged");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT w.id AS workflowid, u.username, bo.titre, w.date_emprunt, w.date_retour
        FROM workflow w
        JOIN users u ON w.id_user = u.id
        JOIN document bo ON w.id_document = bo.id";

$result = mysqli_query($conn, $sql);

echo "<table border='1'>
<tr><th>Borrow ID</th><th>User</th><th>Book</th><th>Borrow Date</th><th>Return Date</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row['workflowid']."</td>
            <td>".$row['username']."</td>
            <td>".$row['titre']."</td>
            <td>".$row['date_emprunt']."</td>
            <td>".$row['date_retour']."</td>
          </tr>";
}
echo "</table>";

mysqli_close($conn);
?>

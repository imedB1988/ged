<?php
// 1. Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "ged");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Get search term from form
$search = "";
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

// 3. Build SQL query
$sql = "SELECT w.id AS workflowid, u.id AS uid, u.username, bo.titre, w.date_emprunt, w.date_retour
        FROM workflow w
        JOIN users u ON w.id_user = u.id
        JOIN document bo ON w.id_document = bo.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Students</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search by name or email" value="<?php echo $search; ?>">
        <input type="submit" value="Search">
    </form>
<a href="insertion/insertform.php">Add Order</a>
    <h2>Results:</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>id user</th><th>username</th><th>Document</th><th>date emprunt</th><th>date retour</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['workflowid'] . "</td>";
                echo "<td>" . $row['uid'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['date_emprunt'] . "</td>";
                 echo "<td>" . $row['date_retour'] . "</td>";
              
         
               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

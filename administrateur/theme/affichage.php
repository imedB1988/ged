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
$sql = "SELECT theme.id, theme.designation FROM theme WHERE theme.designation LIKE '%$search%'";
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
            <th>ID</th><th>Name</th><th>Email</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "<td>
                        <a href='MAJ/edit.php?id=".$row['id']."'>Edit</a> | 
                         <a href='suppression/delete.php?id=".$row['id']."' onclick=\"return confirm('Delete this record?')\">Delete</a>

                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

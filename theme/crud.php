<?php
$host = "localhost";
$user = "root";   // your DB username
$pass = "";       // your DB password
$db   = "ged";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Add new record
if (isset($_POST['add'])) {
    $name  = $_POST['designation'];


    $sql = "INSERT INTO theme (designation) VALUES ('$name')";
    mysqli_query($conn, $sql);
}

// Update record
if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $name  = $_POST['designation'];
   

    $sql = "UPDATE theme SET designation='$name' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Delete record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM theme WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Search
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT theme.id, theme.designation FROM theme WHERE theme.designation LIKE '%$search%' ";
} else {
    $sql = "SELECT * FROM theme";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD + Search</title>
    <style>
        table {border-collapse: collapse; width: 70%;}
        th, td {border: 1px solid #333; padding: 8px; text-align: center;}
        form {margin-bottom: 20px;}
    </style>
</head>
<body>
    <h2>CRUD Table with Search</h2>

    <!-- Add Form -->
    <form method="post">
        <input type="text" name="designation" placeholder="designation" required>
      
        <button type="submit" name="add">Add</button>
    </form>

    <!-- Search Form -->
    <form method="post">
        <input type="text" name="search" placeholder="Search by name/email" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>

    <!-- Data Table -->
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <form method="post">
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="designation" value="<?php echo $row['designation']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="update">Update</button>
                        <a href="crud.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')">Delete</a>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

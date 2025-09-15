<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ged";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Pagination settings
$limit = 3; // records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Get total records
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM theme");
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch records for current page
$sql = "SELECT * FROM theme LIMIT $start, $limit";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagination Example</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px auto; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        ul.pagination { list-style-type: none; text-align: center; padding: 0; }
        ul.pagination li { display: inline; margin: 0 5px; }
        ul.pagination li a { text-decoration: none; padding: 5px 10px; border: 1px solid #000; }
        ul.pagination li a.active { background-color: #000; color: #fff; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Users Table with Pagination</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php while($user = mysqli_fetch_assoc($res)) { ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['designation'] ?></td>
       
    </tr>
    <?php } ?>
</table>

<!-- Pagination Links -->
<ul class="pagination">
    <?php for($i = 1; $i <= $total_pages; $i++) { ?>
        <li><a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a></li>
    <?php } ?>
</ul>

</body>
</html>

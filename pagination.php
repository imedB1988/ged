<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ged");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Number of records per page
$limit = 5;

// Get the current page number from URL, default = 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calculate the starting record
$offset = ($page - 1) * $limit;

// Get total records
$result_count = mysqli_query($conn, "SELECT COUNT(*) AS total FROM theme");
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// Calculate total pages
$total_pages = ceil($total_records / $limit);

// Fetch records for current page
$sql = "SELECT * FROM theme LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagination Example</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        .pagination { text-align: center; margin: 20px; }
        .pagination a { margin: 0 5px; padding: 6px 12px; border: 1px solid #333; text-decoration: none; }
        .pagination a.active { background: #333; color: white; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Students List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['designation']."</td>
                  
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
    }
    ?>
</table>

<div class="pagination">
    <?php
    if ($page > 1) {
        echo "<a href='?page=".($page-1)."'>&laquo; Prev</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? "class='active'" : "";
        echo "<a $active href='?page=$i'>$i</a>";
    }

    if ($page < $total_pages) {
        echo "<a href='?page=".($page+1)."'>Next &raquo;</a>";
    }
    ?>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>

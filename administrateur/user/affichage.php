<?php
include('../..//connectdb.php');
$search = $_GET['search'] ?? '';
$safe = mysqli_real_escape_string($conn, $search);

$sql = "
  SELECT user.id AS user_id,
         user.nom AS user_nom,
         user.prenom,
         role.id,
         role.nom_role
    FROM user
    JOIN role ON role.id = user.id_role
    ORDER BY user_id ASC
";

if ($search !== '') {
    $sql .= " WHERE user.nom LIKE '%$safe%' OR user.prenom LIKE '%$safe%'";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders CRUD with Search & Join</title>
</head>
<body>
<h2>Order List</h2>
<form method="GET">
    <input type="text" name="search" value="<?= htmlentities($search) ?>" placeholder="Search by customer or product">
    <button type="submit">Search</button>
    <a href="insertion/insertform.php">Add Order</a>
</form>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Email</th>
        <th>Product</th>
        <th>Amount</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_array($result)): ?>
        <tr>
            <td><?= htmlentities($row['user_id']) ?></td>
            <td><?= htmlentities($row['user_nom']) ?></td>
            <td><?= htmlentities($row['prenom']) ?></td>
            <td><?= htmlentities($row['id']) ?></td>
            <td><?= htmlentities($row['nom_role']) ?></td>
            <td>
                <a href="MAJ/edit.php?id=<?= urlencode($row['user_id']) ?>">Edit</a> |
                <a href="suppression/delete.php?id=<?= urlencode($row['user_id']) ?>" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
</body>
</html>

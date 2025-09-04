<!-- <a href ="../insertform.php">Insertion Role</a>-->



<!DOCTYPE html>
<html>
<head>
    <title>CRUD with fetch_array</title>
</head>
<body>
    <h2>Add User</h2>
  

    <h2>Role List</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Role</th><th>Action</th>
        </tr>
        <?php
        include '../../connectdb.php';
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nom_role']}</td>
                   
                    <td>
                        <a href='?delete={$row['id']}'>Delete</a> | 
                        <a href='?edit={$row['id']}'>Edit</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>
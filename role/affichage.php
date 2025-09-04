



<!DOCTYPE html>
<html>
<head>
    <title>Liste de roles</title>
</head>
<body>
    <a href ="../../insertform.php">Insertion Role</a>
  

    <h2>Role List</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Role</th><th>Action</th>
        </tr>
        <?php
        include '../connectdb.php';
        $req = "SELECT * FROM role";

        $result = mysqli_query($conn, $req);

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nom_role']}</td>
                   
                    <td>
                        <a href='?delete={$row['id']}'>Delete</a>  
                        
                        </td>
                 </tr>";
        }
        ?>
    </table>
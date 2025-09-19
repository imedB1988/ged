<?php
$conn = mysqli_connect("localhost", "root", "", "ged");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM theme");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD with Modal Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-3">

<div class="container">
    <h2 class="mb-3">Users Table</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['designation'] ?></td>
                <td>
                    <!-- Edit button triggers modal -->
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="<?= $row['id'] ?>"
                        data-name="<?= $row['designation'] ?>"
                     "
                        data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="theme\MAJ\edit.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="edit_id">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="designation" id="edit_designation" class="form-control" required>
            </div>

           
        </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Pass data into modal
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('edit_id').value = button.dataset.id;
        document.getElementById('edit_designation').value = button.dataset.name;
    
    });
});
</script>

</body>
</html>

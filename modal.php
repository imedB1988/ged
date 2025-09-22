<?php include "connectdb.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD with Modals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Users CRUD (PHP + MySQLi + Modal)</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Add User</button>

    <!-- Users Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Created</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm' data-bs-toggle='modal' 
                                data-bs-target='#editModal{$row['id']}'>Edit</button>
                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                data-bs-target='#deleteModal{$row['id']}'>Delete</button>
                    </td>
                </tr>";

            // EDIT MODAL
            echo "
            <div class='modal fade' id='editModal{$row['id']}' tabindex='-1'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <form method='POST' action='update.php'>
                    <div class='modal-header'><h5>Edit User</h5></div>
                    <div class='modal-body'>
                      <input type='hidden' name='id' value='{$row['id']}'>
                      <div class='mb-3'>
                        <label>Name</label>
                        <input type='text' name='username' class='form-control' value='{$row['username']}' required>
                      </div>
                      <div class='mb-3'>
                        <label>Email</label>
                        <input type='email' name='email' class='form-control' value='{$row['email']}' required>
                      </div>
                    </div>
                    <div class='modal-footer'>
                      <button type='submit' class='btn btn-success'>Update</button>
                      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>";

            // DELETE MODAL
            echo "
            <div class='modal fade' id='deleteModal{$row['id']}' tabindex='-1'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <form method='POST' action='delete.php'>
                    <div class='modal-header bg-danger text-white'><h5>Delete User</h5></div>
                    <div class='modal-body'>
                      <input type='hidden' name='id' value='{$row['id']}'>
                      <p>Are you sure you want to delete <b>{$row['username']}</b>?</p>
                    </div>
                    <div class='modal-footer'>
                      <button type='submit' class='btn btn-danger'>Delete</button>
                      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="insert.php">
        <div class="modal-header"><h5>Add User</h5></div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

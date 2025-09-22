<?php include 'components/header.php'?>
<?php include 'components/side_bar.php'?>
<?php include 'components/scriptsjs.php'?>
<?php include 'components/footer.php'?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div >
    <?php include 'components/appcontentheader.php'?>
    <?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ged");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Default values
$limit = 6
; // records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search keyword
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";

// Build WHERE condition for search
$where = "";
if (!empty($search)) {
    $where = "WHERE theme.designation LIKE '%$search%' ";
}

// Get total records
$sqlCount = "SELECT COUNT(*) AS total FROM theme $where";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$total_records = $rowCount['total'];
$total_pages = ceil($total_records / $limit);

// Get records for current page
$sql = "SELECT * FROM theme $where ORDER BY id ASC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>


<div class="app-content ">
    
   <!-- Search Form -->
    <form method="get" class="row  mb-4">
        <div class="col-md-8">
            <input type="text" name="search" value="<?php echo $search; ?>" 
                   class="form-control" placeholder="Recherche d'un thème">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-dark">Rechercher</button>  
        </div>
    </form>
<a href="insertion/insertform.php"  class="form-control btn btn-dark  btn-block mb-4" data-bs-toggle="modal" data-bs-target="#insertModal">Ajouter un thème</a>
    
<!-- Insert Modal -->
<div class="modal fade" id="insertModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="insertion/insert.php">
      
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un thème</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Désignation</label>
            <input type="text" name="designation" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-success">Insérer</button>
         
        </div>
      </div>
    </form>
  </div>

   <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-<?php echo $alertType; ?> text-white">
            <h5 class="modal-title"><?php echo ucfirst($alertType); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <?php echo $message; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-<?php echo $alertType; ?>" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($message)) : ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
        myModal.show();
    </script>
    <?php endif; ?>
</div>


<!-- End Insert Modal -->



    <!-- Users Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>ID</th><th>Theme</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total_records > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="text-center">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td>
                                <!-- <a href="MAJ/edit.php?id=<?= $row['id'] ?>" class="btn btn-lg btn-warning">Modifier</a>-->
                                 
                                
                                <!-- <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-lg btn-danger">Supprimer</a> -->
                                  <!-- Delete Button -->
          
           <div class="d-grid gap-2 col-6 mx-auto">
  <button type="button" class="btn btn-dark  editBtn"
                        data-id="<?= $row['id'] ?>"
                        data-name="<?= $row['designation'] ?>"
                     "
                        data-bs-toggle="modal" data-bs-target="#editModal" >
                        Modifier
                    </button>
    <button 
              class="btn btn-dark   deleteBtn" 
              data-id="<?= $row['id']; ?>" 
              data-bs-toggle="modal" 
              data-bs-target="#deleteModal">
              Supprimer
            </button>
</div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center">No records found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="MAJ\edit.php" method="POST">
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="delete.php">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this record?</p>
          <input type="hidden" name="delete_id" id="delete_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="deleteBtn" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  // Pass ID to modal input
  const deleteButtons = document.querySelectorAll(".deleteBtn");
  deleteButtons.forEach(btn => {
    btn.addEventListener("click", function(){
      document.getElementById("delete_id").value = this.dataset.id;
    });
  });
</script>


<script>
// Pass data into modal
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('edit_id').value = button.dataset.id;
        document.getElementById('edit_designation').value = button.dataset.name;
    
    });
});
</script>

    <!-- Pagination -->
    <nav class="mt-3 " >
        <ul class="pagination justify-content-center  ">
            <!-- Previous button -->
            <li class="page-item">
                <a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>">Previous</a>
            </li>

            <!-- Page numbers -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item ">
                    <a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <!-- Next button -->
            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                <a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $page+1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php mysqli_close($conn); ?>



   

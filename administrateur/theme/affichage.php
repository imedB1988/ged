<?php include 'components/header.php'?>
<?php include 'components/side_bar.php'?>
<?php include 'components/scriptsjs.php'?>
<?php include 'components/footer.php'?>


<div >
    <?php include 'components/appcontentheader.php'?>
    <?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ged");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Default values
$limit = 7
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
<a href="insertion/insertform.php"  class="form-control btn btn-dark  btn-block mb-4" onclick="loadPage('insertion/insertform.php')">Ajouter un thème</a>
    
    <!-- Users Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th><th>Theme</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total_records > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td>
                                <a href="MAJ/edit.php?id=<?= $row['id'] ?>" class="btn btn-lg btn-warning">Modifier</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-lg btn-danger">Supprimer</a>
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
                        <!-- begin modal delete -->
                         <!-- Modal -->
<div class="modal fade" id="msgModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header <?= ($status=='success'?'bg-success':'bg-danger') ?> text-white">
        <h5 class="modal-title"><?= ucfirst($status) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?= $message ?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!empty($message)) { ?>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('msgModal'));
    myModal.show();
</script>
<?php } ?>
                         <!-- end modal delete -->
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



   

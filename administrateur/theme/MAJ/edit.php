<?php
$conn = mysqli_connect("localhost", "root", "", "ged");

$message = "";
$alertType = "";

    if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $name  = $_POST['designation'];
  

    $query = "UPDATE theme SET designation='$name' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
         $message = "Record updated successfully!";
        $alertType = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $alertType = "danger";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">



<!-- Modal -->
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
        <a href="index.php" class="btn btn-<?php echo $alertType; ?>">OK</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!empty($message)) : ?>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
    myModal.show();
</script>
<?php endif; ?>

</body>
</html>
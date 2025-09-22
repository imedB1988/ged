<?php
$conn = mysqli_connect("localhost", "root", "", "ged");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$alertType = ""; // success or danger

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['designation']);

    $sql = "INSERT INTO theme (designation) VALUES ('$name')";
    if (mysqli_query($conn, $sql)) {
        $message = "Record inserted successfully!";
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
    <title>Insert Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <!-- Modal -->
    <div class="modal fade show" id="messageModal" tabindex="-1" aria-hidden="true" style="display:block;" aria-modal="true" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-<?php echo $alertType; ?> text-white">
            <h5 class="modal-title"><?php echo ucfirst($alertType); ?></h5>
          </div>
          <div class="modal-body">
            <?php echo $message; ?>
          </div>
          <div class="modal-footer">
            <a href="form.php" class="btn btn-<?php echo $alertType; ?>">OK</a>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Automatically show the modal
        var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
        myModal.show();
    </script>
</body>
</html>

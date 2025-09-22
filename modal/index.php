<!DOCTYPE html>
<html>
<head>
    <title>Insert with Modal Message</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="container">
        <h2>Insert Form</h2>
        <!-- form sends data to insert.php -->
        <form method="POST" action="insert.php">
            <div class="mb-3">
                <label for="name" class="form-label">Enter Name</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

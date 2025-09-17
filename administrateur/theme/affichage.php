<?php include 'components/header.php'?>
<?php include 'components/side_bar.php'?>
<?php include 'components/scriptsjs.php'?>

<?php include 'components/footer.php'?>

<div class="app-main">
    <?php include 'components/appcontentheader.php'?>
    <?php
include '../../connectdb.php';
// 2. Get search term from form
$search = "";
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

// 3. Build SQL query
$sql = "SELECT theme.id, theme.designation FROM theme WHERE theme.designation LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>
    <form method="post" action="" class="input-group mb-2">
        <input type="text" name="search" class="form-control" placeholder="Recherche d'un thème" value="<?php echo $search; ?>">
        <input type="submit" value="Rechercher" class="btn btn-dark">
    </form>
         <a href="insertion/insertform.php" type="button" class="btn btn-secondary " >Ajouter un thème</a>
         <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">

                </div>
                  
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                
              </div>
              <!-- /.col -->

        </div>
</div>

</div>
    
    <h2>Results:</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "<td>
                        <a href='MAJ/edit.php?id=".$row['id']."'>Edit</a> | 
                         <a href='suppression/delete.php?id=".$row['id']."' onclick=\"return confirm('Delete this record?')\">Delete</a>

                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>



    <!-- table table -->

    <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                 <?php
                        //include '../connectdb.php';
                        // Number of records per page
$records_per_page = 2;

// Get total records
$sql = "SELECT COUNT(*) AS total FROM theme"; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

// Total pages
$total_pages = ceil($total_records / $records_per_page);

// Get current page from dropdown
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

// Offset
$start_from = ($page - 1) * $records_per_page;
?>  
                <div class="card-header">
                    <h3 class="card-title">Themes </h3>
                    
                    <div class="card-tools">
                       <?php 
                  // Dropdown pagination
echo "<form method='get'>";
echo "Page: <select name='page' onchange='this.form.submit()'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $selected = ($i == $page) ? "selected" : "";
    echo "<option value='$i' $selected>$i</option>";
}
echo "</select>";
echo "</form>";
                  ?>

                  
                    </div>
                        
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                      
                    <table class="table" >
                      <thead>
                        <tr>
                        
                          <th style="width: 10px">#</th>
                          <th>Theme</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- <tr class="align-middle"> -->
                     <?php
// Fetch data
$sql = "SELECT * FROM theme LIMIT $start_from, $records_per_page";
                        $result = mysqli_query($conn, $sql);
                        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['designation'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        

                        ?>
                      </tbody>
                    </table>
                  </div>
                  
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                
              </div>
              <!-- /.col -->

</div>

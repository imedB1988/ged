<?php
include '../../connectdb.php';



if($conn)
{
    $roles=$_POST['roles'];
   $sql = "INSERT INTO role (nom_role) VALUES ('$roles')";

  if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


}

?>
<?php
// check request
if(isset($_POST['app_ID']) && isset($_POST['app_ID']) != "")
{
    // include Database connection file
    include("config.php");

    // get user id
    $id = $_POST['app_ID'];

    // delete User
   // $query = "DELETE FROM appointment WHERE app_ID = '$id'";
   // if (!$result = mysqli_query($conn,$query)) {
     //   exit(mysqli_error());
   // }
   $stmt = $conn->prepare("DELETE FROM appointment WHERE app_ID = ?");
   $stmt->bind_param("i", $id);
   $stmt->execute();
}
?>
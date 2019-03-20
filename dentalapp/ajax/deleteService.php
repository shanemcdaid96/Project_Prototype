<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("config.php");

    // get user id
    $id = $_POST['id'];

    // delete User
    $query = "DELETE FROM services WHERE service_id = '$id'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
?>
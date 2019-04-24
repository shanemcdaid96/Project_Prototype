<?php

// check request
if(isset($_POST['app_ID']) && isset($_POST['app_ID']) != "")
{
    // include Database connection file
    include("config.php");

    // get appointment id
    $id = $_POST['app_ID'];

    // delete Appointment

   $stmt = $conn->prepare("DELETE FROM appointment WHERE app_ID = ?");
   $stmt->bind_param("i", $id);
   $stmt->execute();
}
?>
<?php

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("config.php");

    // get service id
    $id = $_POST['id'];

    // delete User
    $stmt = $conn->prepare("DELETE FROM services WHERE service_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();


}
?>
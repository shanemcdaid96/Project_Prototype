<?php

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("config.php");

   //set value of Id to the POST value
    $id = $_POST['id'];


    $stmt = $conn->prepare("DELETE FROM trend_alerts WHERE alert_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();


}
?>
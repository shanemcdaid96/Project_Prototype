<?php
    include("config.php");
    
    		   //Get Dentist ID
               $sql = "SELECT * FROM dentists WHERE Full_Title='$_GET[dentist]'";
               $result = mysqli_query($conn, $sql);
               $row = mysqli_fetch_assoc($result);
               $dentistID = $row['Dentist_Id'];

    $appDate = $_GET['appDate'];
    $appTime = $_GET['appTime'];

/* Query */
$query = "select count(*) as count FROM appointment WHERE dentistID='$dentistID' AND appDate='$appDate' AND appTime='$appTime'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_array($result);

$count = $row['count'];

echo $count;

?>
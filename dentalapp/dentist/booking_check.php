<?php

    include("../config.php");
    include("authDentist.php");

    
   
               $dentistID = $_SESSION['dID'];

    $appDate = $_GET['appDate'];
    $appTime = $_GET['appTime'];

/* Get number of appointments matching the passed values */
$query = "select count(*) as count FROM appointment WHERE dentistID='$dentistID' AND appDate='$appDate' AND appTime='$appTime'";
$query = $conn->prepare("select count(*) as count FROM appointment WHERE dentistID=? AND appDate=? AND appTime=?");
$query->bind_param("iss", $dentistID,$appDate,$appTime);
$query->execute();
$result = $query->get_result();
if($result->num_rows > 0)
{
while($row=$result->fetch_assoc()){

$count = $row['count'];

echo $count;
}
}
?>
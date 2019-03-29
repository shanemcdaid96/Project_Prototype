<?php
    include("config.php");
    
    		   //Get Dentist ID
              // $sql = "SELECT * FROM dentists WHERE Full_Title='$_GET[dentist]'";
               //$result = mysqli_query($conn, $sql);
               //$row = mysqli_fetch_assoc($result);
               //$dentistID = $row['Dentist_Id'];
               $sql= $conn->prepare("SELECT Dentist_Id FROM dentists WHERE Full_Title=?");
               $sql->bind_param("s", $_GET["dentist"]);
               $sql->execute();
               $sql->store_result();
               $sql->bind_result($Dentist_Id);
               $sql->fetch();
               $dentistID=$Dentist_Id;

    $appDate = $_GET['appDate'];
    $appTime = $_GET['appTime'];

/* Query */
//$query = "select count(*) as count FROM appointment WHERE dentistID='$dentistID' AND appDate='$appDate' AND appTime='$appTime'";
$query = $conn->prepare("select count(*) as count FROM appointment WHERE dentistID=? AND appDate=? AND appTime=?");
$query->bind_param("iss", $dentistID,$appDate,$appTime);
$query->execute();
$result = $query->get_result();
if($result->num_rows > 0)
{
while($row=$result->fetch_assoc()){
//$result = mysqli_query($conn,$query);

//$row = mysqli_fetch_array($result);

$count = $row['count'];

echo $count;
}
}
?>
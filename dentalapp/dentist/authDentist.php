<?php
require('../config.php');
session_start();

/*$sql = "SELECT * FROM dentists WHERE Email_Address='$_SESSION[emailDentist]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $_SESSION["name"]=$row['Full_Title'];
       $_SESSION["dID"]=$row['Dentist_Id'];
    }
}*/
$stmt= $conn->prepare($query = "SELECT Full_Title,Dentist_Id FROM dentists WHERE Email_Address=?");
$stmt->bind_param("s", $_SESSION["emailDentist"]);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
  // output data of each row
  $stmt->bind_result($Full_Title,$Dentist_Id);
  while($stmt->fetch()) {
    $_SESSION["name"]=$Full_Title;
    $_SESSION["dID"]=$Dentist_Id;
 }

}



if(!isset($_SESSION["emailDentist"])){
header("Location: login.php");
exit(); }
?>
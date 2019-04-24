<?php
require('config.php');
session_start();


$stmt= $conn->prepare($query = "SELECT First_Name,Surname,Id,DOB FROM  patients WHERE Email_Address=?");
$stmt->bind_param("s", $_SESSION["email"]);
$stmt->execute();
$stmt->store_result();
   if ($stmt->num_rows > 0) {
// output data of each row
      $stmt->bind_result($First_Name,$Surname,$Id,$DOB);
      while($stmt->fetch()) {
      $_SESSION["firstname"]=$First_Name;
      $_SESSION["surname"]=$Surname;
      $_SESSION["id"]=$Id;
      $_SESSION["dob"]=$DOB;
      }

   }


   if(!isset($_SESSION["email"])){
      header("Location: index.php");
      exit(); }
?>
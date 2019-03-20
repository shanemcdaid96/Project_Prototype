<?php
require('config.php');
session_start();

$sql = "SELECT * FROM patients WHERE Email_Address='$_SESSION[email]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $_SESSION["firstname"]=$row['First_Name'];
       $_SESSION["surname"]=$row['Surname'];
       $_SESSION["id"]=$row['Id'];
       $_SESSION["dob"]=$row['DOB'];
    }
}
if(!isset($_SESSION["email"])){
header("Location: index.php");
exit(); }
?>

<?php
session_start();
require('config.php');
 
$email=$_POST["email"];
$password=md5($_POST["password"]);
$date = date('Y-m-d H:i:s');

//Get user details
$stmt= $conn->prepare($query = "SELECT Email_Address, Add_Time FROM  patients WHERE Email_Address=? AND Password=?");
$stmt->bind_param("ss", $email,$password);
$stmt->execute();
$stmt->store_result();
//If user exists in database
if($stmt->num_rows > 0){
	$stmt->bind_result($Email_Address,$Add_Time);
	$stmt->fetch();
	$_SESSION['email'] = $Email_Address;
	//set date value equal to the add_time value of the patient 
	$date2=$Add_Time;
   
	//if the patient has no account lock time or the lock time has expired
	if($date2=="" || $date2 < $date  ){
		echo 0;	 //log user in
		}else{
	   echo 2;//prevent user from logging in
		}


} else{
	echo 1;	//Invalid username or password
}
//CHECK  index.php for further information about the account lock
?>

<?php
session_start();
require('config.php');
 
$email=$_POST["email"];
$password=md5($_POST["password"]);
$date = date('Y-m-d H:i:s');

$stmt= $conn->prepare($query = "SELECT Email_Address, Add_Time FROM  patients WHERE Email_Address=? AND Password=?");
$stmt->bind_param("ss", $email,$password);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0){
	$stmt->bind_result($Email_Address,$Add_Time);
	$stmt->fetch();
	$_SESSION['email'] = $Email_Address;
	$date2=$Add_Time;
	if($date2=="" || $date2 < $date  ){
		echo 0;	 
		}else{
	   echo 2;
		}


} else{
	echo 1;	
}


/*$userq=mysqli_query($conn,"select * from patients where Email_Address='".$email."' and Password='".md5($password)."'");
 
$numrows=mysqli_num_rows($userq);
if($numrows>0)
{
	$data=mysqli_fetch_array($userq);
        
    $_SESSION['email'] = $data['Email_Address'];
$_SESSION["firstname"]=$data['First_Name'];
 $date2 = $data['Add_Time'];
	 
     	if($date2=="" || $date2 < $date  ){
		 echo 0;	 
		 }else{
		echo 2;
		 }
}
else{
	echo 1;					
	}*/						
	
?>
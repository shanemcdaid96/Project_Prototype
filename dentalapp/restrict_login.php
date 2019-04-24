
<?php
require('config.php');

//Get user's email address
$email=$_POST["email"];
$time = 30 * 60; //30 minutes
$date = date(('Y-m-d H:i:s'),time()+$time);
//add a lockout time to the user's account
$query = "  
UPDATE patients   
SET Add_Time='$date' 
WHERE Email_Address='$email'";  
if (!$result = mysqli_query($conn,$query)) {
exit(mysqli_error());
}
	
?>
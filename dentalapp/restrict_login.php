
<?php
require('config.php');
 
$email=$_POST["email"];
$time = 30 * 60; //30 minutes
$date = date(('Y-m-d H:i:s'),time()+$time);
$query = "  
UPDATE patients   
SET Add_Time='$date' 
WHERE Email_Address='$email'";  
if (!$result = mysqli_query($conn,$query)) {
exit(mysqli_error());
}
	
?>
<?php
	if(isset($_POST['appTime']) && isset($_POST['appDate']))
	{
		// include Database connection file 
		include("config.php");

		   //Get Dentist ID
		   $sql = "SELECT * FROM dentists WHERE Full_Title='$_POST[dentist_id]'";
		   $result = mysqli_query($conn, $sql);
		   $row = mysqli_fetch_assoc($result);
		   $dentistID = $row['Dentist_Id'];
		  //Get Selected Service ID
		   $sql2 = "SELECT * FROM services WHERE service_type='$_POST[service_id]'";
			 $result = mysqli_query($conn, $sql2);
			 $row1 = mysqli_fetch_assoc($result);
			 $serviceID = $row1['service_id'];

		// get values 
		$id = $_POST['user_id'];
		$appTime = $_POST['appTime'];
		$appDate = $_POST['appDate'];
		$payment = $_POST['payment'];

		  //Check for Double Booking
		  $bookingcheck="SELECT * FROM appointment WHERE dentistID='$dentistID' AND appDate='$appDate' AND appTime='$appTime'";
		  $resultCheck = $conn->query($bookingcheck);   

		      //If no records exist, book appointment
			  if ($resultCheck->num_rows > 0) {
				// output data of each row
				while($rowCheck = $resultCheck->fetch_assoc()) {
					echo '<script src="../js/doublebooking.js"></script>';
				}
		   }else{
		     $query = " INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
		      VALUES('$appDate', '$appTime', '$dentistID', '$id', '$serviceID','$payment')";
		          if (!$result = mysqli_query($conn,$query)) {
	                 exit(mysqli_error());
	                  }
	    	}
}
?>
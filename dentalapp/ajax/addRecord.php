<?php
	if(isset($_POST['appTime']) && isset($_POST['appDate']))
	{
		// include Database connection file 
		include("config.php");

		   //Get Dentist ID
			 $sql= $conn->prepare("SELECT Dentist_Id FROM dentists WHERE Full_Title=?");
			 $sql->bind_param("s", $_POST["dentist_id"]);
			 $sql->execute();
			 $sql->store_result();
			 $sql->bind_result($Dentist_Id);
			 $sql->fetch();
			 $dentistID=$Dentist_Id;

		  //Get Selected Service ID
			 $sql2= $conn->prepare("SELECT service_id FROM services WHERE service_type=?");
			 $sql2->bind_param("s", $_POST["service_id"]);
			 $sql2->execute();
			 $sql2->store_result();
			 $sql2->bind_result($service_id);
			 $sql2->fetch();
			 $serviceID=$service_id;

		// get values 
		$id = $_POST['user_id'];
		$appTime = $_POST['appTime'];
		$appDate = $_POST['appDate'];
		$payment = $_POST['payment'];

		  //Check for Double Booking
		  $bookingcheck=$conn->prepare("SELECT app_ID FROM appointment WHERE dentistID=? AND appDate=? AND appTime=?");
          $bookingcheck->bind_param("iss", $dentistID,$appDate,$appTime);
          $bookingcheck->execute();
          $bookingcheck->store_result();
         // $resultCheck = $conn->query($bookingcheck);   
          if ($bookingcheck->num_rows > 0) {
            // output data of each row
            $bookingcheck->bind_result($app_ID);
            while($rowCheck = $bookingcheck->fetch_assoc()) {
                echo '<script src="../js/doublebooking.js"></script>';
            }
		   }else{
		   /*  $query = " INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
		      VALUES('$appDate', '$appTime', '$dentistID', '$id', '$serviceID','$payment')";
		          if (!$result = mysqli_query($conn,$query)) {
	                 exit(mysqli_error());
										}*/
						$stmt = $conn->prepare("INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
						VALUES(?,?,?,?,?,?)");
						$stmt->bind_param("ssiiis",$appDate,$appTime,$dentistID,$id,$serviceID,$payment);
						$stmt->execute();
	    	}
}
?>
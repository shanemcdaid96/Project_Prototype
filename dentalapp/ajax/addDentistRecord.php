<?php
	if(isset($_POST['appTime']) && isset($_POST['appDate']))
	{
		// include Database connection file 
		include("config.php");

		   //Get User ID
		  // $sql = "SELECT * FROM patients WHERE Email_Address LIKE '%$_POST[patient]%' OR Id LIKE '$_POST[patient]%' LIMIT 1";
		   //$result = mysqli_query($conn, $sql);
		   //$row = mysqli_fetch_assoc($result);
			 //$userID = $row['Id'];
			$sql= $conn->prepare("SELECT * FROM patients WHERE Email_Address LIKE ? OR Id LIKE ?");
			$search1 = '%'.$_POST['patient'].'%';
			$search2 = $_POST['patient'].'%';
			$sql->bind_param("si",$search1,$search2);
			$sql->execute();
			$result=$sql->get_result();
      $row=$result->fetch_assoc();
			$userID=$row["Id"];

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
			$bookingcheck->bind_param("iss", $id,$appDate,$appTime);
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
		    /* $query = " INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
		      VALUES('$appDate', '$appTime', '$id', '$userID', '$serviceID','$payment')";
		          if (!$result = mysqli_query($conn,$query)) {
	                 exit(mysqli_error());
										}*/
					$stmt = $conn->prepare("INSERT INTO appointment(appDate, appTime, dentistID, userID, serviceID, paymentMethod)  
					VALUES(?,?,?,?,?,?)");
					$stmt->bind_param("ssiiis",$appDate,$appTime,$id,$userID,$serviceID,$payment);
					$stmt->execute();					
	    	}
}
?>
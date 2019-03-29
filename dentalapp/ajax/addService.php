<?php
	if(isset($_POST['service']) && isset($_POST['price']))
	{
		// include Database connection file 
		include("config.php");

		// get values 
		$service = $_POST['service'];
		$price = $_POST['price'];

		/*     $query = " INSERT INTO services(service_type, price)  
		      VALUES('$service','$price')";
		          if (!$result = mysqli_query($conn,$query)) {
	                 exit(mysqli_error());
					  }*/
					  
		$stmt = $conn->prepare("INSERT INTO services(service_type, price)  
		VALUES(?,?)");
		$stmt->bind_param("ss",$service,$price);
		$stmt->execute();

}
?>
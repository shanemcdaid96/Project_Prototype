<?php

	if(isset($_POST['message']) && isset($_POST['min']))
	{
		// include Database connection file 
		include("config.php");

		// get values 
		$message = $_POST['message'];
        $min = $_POST['min'];
        $max = $_POST['max'];

        //getServiceID
        $sql2= $conn->prepare("SELECT service_id FROM services WHERE service_type=?");
        $sql2->bind_param("s", $_POST["service"]);
        $sql2->execute();
        $sql2->store_result();
        $sql2->bind_result($service_id);
        $sql2->fetch();
        $serviceID=$service_id;

		//add new alert to the database 
		$stmt = $conn->prepare("INSERT INTO trend_alerts(message, min_age, max_age, treatment_id)  
		VALUES(?,?,?,?)");
		$stmt->bind_param("siii",$message,$min,$max,$serviceID);
		$stmt->execute();

}
?>
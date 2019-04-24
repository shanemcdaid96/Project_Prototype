<?php
// include Database connection file
include("config.php");

// check request
if(isset($_POST))
{
    // get values
	    $service = $_POST['service'];
		$price = $_POST['price'];
        $id = $_POST['id'];

    // Update Service details
    $stmt = $conn->prepare("UPDATE services SET service_type=?, price =? WHERE service_id=?");
    $stmt->bind_param("ssi",$service,$price,$id);
    $stmt->execute();
}

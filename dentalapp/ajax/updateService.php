<?php
// include Database connection file
include("config.php");
//include("../auth.php");

// check request
if(isset($_POST))
{
    // get values
	    $service = $_POST['service'];
		$price = $_POST['price'];
        $id = $_POST['id'];

    // Update User details
        /*   $query = "  
           UPDATE services   
           SET service_type='$service',   
           price='$price'   
           WHERE service_id='$id'";  
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }*/
    $stmt = $conn->prepare("UPDATE services SET service_type=?, price =? WHERE service_id=?");
    $stmt->bind_param("ssi",$service,$price,$id);
    $stmt->execute();
}

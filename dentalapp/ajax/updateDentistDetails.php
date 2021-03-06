<?php
// include Database connection file
include("config.php");
include("../dentist/authDentist.php");

// check request
if(isset($_POST))
{
      //Get User ID
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
	    $appTime = $_POST['appTime'];
		$appDate = $_POST['appDate'];
        $payment = $_POST['payment'];
        $id = $_POST['id'];

        		  //Check for Double Booking
        $bookingcheck=$conn->prepare("SELECT app_ID FROM appointment WHERE dentistID=? AND appDate=? AND appTime=?");
        $bookingcheck->bind_param("iss", $_SESSION["dID"],$appDate,$appTime);
        $bookingcheck->execute();
        $bookingcheck->store_result();
         
        if ($bookingcheck->num_rows > 0) {
      
        $bookingcheck->bind_result($app_ID);
        while($rowCheck = $bookingcheck->fetch_assoc()) {
            echo '<script src="../js/doublebooking.js"></script>';
        }
       }else{
    // Update Appointment details
    $stmt = $conn->prepare("UPDATE appointment SET appDate=?, 
    appTime=?,   
    dentistID=?,   
    userID = ?,   
    serviceID =?,
    paymentMethod =?   
    WHERE app_ID=?");
    $stmt->bind_param("ssiiisi",$appDate,$appTime,$_SESSION["dID"],$userID,$serviceID,$payment,$id);
    $stmt->execute();

    
  }
}

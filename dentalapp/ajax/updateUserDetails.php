<?php
// include Database connection file
include("config.php");
include("../auth.php");

// check request
if(isset($_POST))
{
      //Get Dentist ID
    /* $sql = "SELECT * FROM dentists WHERE Full_Title='$_POST[dentist_id]'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $dentistID = $row['Dentist_Id'];*/
      $sql= $conn->prepare("SELECT Dentist_Id FROM dentists WHERE Full_Title=?");
      $sql->bind_param("s", $_POST["dentist_id"]);
      $sql->execute();
      $sql->store_result();
      $sql->bind_result($Dentist_Id);
      $sql->fetch();
      $dentistID=$Dentist_Id;
    

     //Get Selected Service ID
     // $sql2 = "SELECT * FROM services WHERE service_type='$_POST[service_id]'";
       // $result = mysqli_query($conn, $sql2);
        //$row1 = mysqli_fetch_assoc($result);
        //$serviceID = $row1['service_id'];
        $sql2= $conn->prepare("SELECT service_id FROM services WHERE service_type=?");
        $sql2->bind_param("s", $_POST["service"]);
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
    // Update User details
        /*   $query = "  
           UPDATE appointment   
           SET appDate='$appDate',   
           appTime='$appTime',   
           dentistID='$dentistID',   
           userID = '$_SESSION[id]',   
           serviceID = '$serviceID',
           paymentMethod = '$payment'   
           WHERE app_ID='$id'";  
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }*/
    $stmt = $conn->prepare("UPDATE appointment SET appDate=?, 
    appTime=?,   
    dentistID=?,   
    userID = ?,   
    serviceID =?,
    paymentMethod =?   
    WHERE app_ID=?");
    $stmt->bind_param("ssiiisi",$appDate,$appTime,$dentistID,$_SESSION["id"],$serviceID,$payment,$id);
    $stmt->execute();
  }
}

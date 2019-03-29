<?php
// include Database connection file
include("config.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $id = $_POST['id'];

    // Get User Details
  /*  $query = "SELECT * FROM appointment a , patients p, services s WHERE a.app_ID = '$id' AND a.userID=p.Id AND a.serviceID=s.service_id";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }*/
    $stmt= $conn->prepare($query = "SELECT * FROM appointment a , patients p, services s WHERE a.app_ID =? AND a.userID=p.Id AND a.serviceID=s.service_id");
    $stmt->bind_param("i", $id);
    $id = $_POST["id"];
    $stmt->execute();
   $result=$stmt->get_result();
    $response = array();
  //  if(mysqli_num_rows($result) > 0) {
    if($result->num_rows>0){
    //    while ($row = mysqli_fetch_assoc($result)) {
        while($row=$result->fetch_assoc()){
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";

}
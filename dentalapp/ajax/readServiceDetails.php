<?php
// include Database connection file
include("config.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get Service ID
    $id = $_POST['id'];

    // Get Service Details
    $stmt= $conn->prepare($query = "SELECT * FROM services WHERE service_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
   $result=$stmt->get_result();
    $response = array();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()) {
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
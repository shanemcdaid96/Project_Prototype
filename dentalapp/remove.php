<?php


require('config.php');


if(isset($_GET['app_ID']))
{
     $sql = "DELETE FROM appointment WHERE app_ID=".$_GET['app_ID'];
     $result = mysqli_query($conn, $sql);
     $message = 'Appointment Deleted';

     
}


?>
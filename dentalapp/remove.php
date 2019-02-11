<?php


require('config.php');


if(isset($_GET['id']))
{
     $sql = "DELETE FROM appointment WHERE app_ID=".$_GET['id'];
     $result = mysqli_query($conn, $sql);
}


?>
<?php
  require('dbtrends.php');
 
    //get all of the Amalgam Fillings data from database
    $myquery = "
    SELECT * FROM recent_trends WHERE treatment = 'Amalgam Fillings'";
    $query = mysqli_query($conn,$myquery);

    if ( ! $query ) {
        echo mysqli_error();
        die;
    }

    $data = array();

    for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
    }
   //return array in JSON format
     echo json_encode($data);


    
?>
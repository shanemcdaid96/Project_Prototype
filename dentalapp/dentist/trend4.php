<?php
  require('dbtrends.php');
	if(isset($_GET['choice']))
	{
    //Get value of service radio button
   $choice=$_GET['choice']; 
   $myquery = "
   SELECT * FROM fees WHERE treatment LIKE '%$choice%'";
  }
  else{
    $myquery = "
    SELECT * FROM fees WHERE treatment LIKE '%Composite%' OR treatment LIKE '%Amalgam%'";
    }


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

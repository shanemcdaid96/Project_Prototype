<?php
  require('dbtrends.php');

    $myquery = "
    SELECT * FROM fees WHERE treatment LIKE '%Composite%' OR treatment LIKE '%Amalgam%'";
    $query = mysqli_query($conn,$myquery);

    if ( ! $query ) {
        echo mysqli_error();
        die;
    }

    $data = array();

    for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
    }

     echo json_encode($data);


    
?>

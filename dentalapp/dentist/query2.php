<?php
require("../config.php");

  if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
    
     //Search for patient by email address or id
    $query = "SELECT * FROM patients WHERE Email_Address LIKE '%$search_query%' OR Id LIKE '$search_query%' LIMIT 1";
    $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_array($result)) {
      //display results
    echo $row['First_Name'], ' ',$row['Surname'];
    echo "<br>Date 0f Birth:",$row['DOB'];
    echo "<br>Phone Number:",$row['Phone_Number'];
    echo "<br>(Security)Childhood Hero:",$row['Childhood_Hero'];
  }
} else {
  echo "<p style='color:red'>Patient not found...</p>";
}
}
?>
<?php

	// include Database connection file 
	include("config.php");

	// Design initial table header 
	$data = '      <table class="table">
						<tr>
						
							<th>Message</th>
							<th>Min Age</th>
							<th>Max Age</th>
							<th>Service</th>
						</tr>';


	$query = $conn->prepare("SELECT * FROM trend_alerts t, services s WHERE s.service_id=t.treatment_id");
	$query->execute();
	$result = $query->get_result();

  if($result->num_rows > 0)
    {
			//if there is at lest one trend alert in the database
    	$number = 1;
	while($row=$result->fetch_assoc())
    	{
    		$data .= '<tr>
				<td>'.$row['message'].'</td>
				<td> '.$row['min_age'].'</td>
				<td> '.$row['max_age'].'</td>
				<td>'.$row['service_type'].'</td>
				<td>
					<button type="button" onclick="DeleteAlert('.$row['alert_id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No Alerts in Database</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
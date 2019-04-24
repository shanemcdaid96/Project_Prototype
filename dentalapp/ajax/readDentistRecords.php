<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
<?php

	// include Database connection file 
	include("config.php");
	include("../dentist/authDentist.php");

	//get current date
	$current_date=date("m/d/Y");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
						
							<th>Time</th>
							<th>Date</th>
							<th>Details</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';
//Find appointments were the date is greater than current date and the dentist is the one currently logged in
$query = $conn->prepare("SELECT * FROM appointment WHERE dentistID = ? AND appDate >= ?");
$query->bind_param("is", $_SESSION["dID"],$current_date);
$query->execute();
$result = $query->get_result();
	


	// if query results contains rows then fetch those rows 

  if($result->num_rows > 0)
    {
    	$number = 1;
		while($row=$result->fetch_assoc())
    	{
    		$data .= '<tr>
				<td>'.$row['appTime'].'</td>
				<td>'.$row['appDate'].'</td>
				<td>
					<button onclick="viewDentistDetails('.$row['app_ID'].')" class="btn btn-secondary">View</button>
				</td>
				<td>
					<button onclick="GetDentistDetails('.$row['app_ID'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteDentist('.$row['app_ID'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Dentist currently has no appointments!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
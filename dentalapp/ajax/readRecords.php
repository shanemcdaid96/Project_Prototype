<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  
<?php
	// include Database connection file 
	include("config.php");
	include("../auth.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
						
							<th>Time</th>
							<th>Date</th>
							<th>Details</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

	$query = "SELECT * FROM appointment WHERE userID ='$_SESSION[id]'";

	if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td>'.$row['appTime'].'</td>
				<td>'.$row['appDate'].'</td>
				<td>
					<button onclick="viewUserDetails('.$row['app_ID'].')" class="btn btn-secondary">View</button>
				</td>
				<td>
					<button onclick="GetUserDetails('.$row['app_ID'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['app_ID'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">User currently has no appointments!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
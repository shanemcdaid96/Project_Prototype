<?php
	// include Database connection file 
	include("config.php");

	// Design initial table header 
	$data = '      <table class="table">
						<tr>
						
							<th>Service</th>
							<th>Price</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

	$query = "SELECT * FROM services";

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
				<td>'.$row['service_type'].'</td>
				<td> €'.$row['price'].'</td>
				<td>
					<button type="button" onclick="GetService('.$row['service_id'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button type="button" onclick="DeleteService('.$row['service_id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No Services in Database</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
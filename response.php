<?php 
	
	require_once ($_SERVER['DOCUMENT_ROOT']."/admin/conn.php");
  	$conn = main_db_connect();
	
	if (isset($_POST['roll']) && isset($_POST['response'])) 
	{
		$roll = mysqli_real_escape_string($conn,addslashes($_POST['roll']));
		$response = json_decode($_POST['response']);

		$query = '';

		foreach ($response as $key => $value) 
		{
			$res = $conn->query("SELECT `response_id` FROM `response` WHERE `roll` = '$roll' AND `sub_id` = '$key'");
			if($res->num_rows > 0)
				$query .= "UPDATE `response` SET `response`='$value' WHERE `roll` = '$roll' AND `sub_id` = '$key';";
			else
				$query .= "INSERT INTO `response`(`roll`, `sub_id`, `response`) VALUES ('$roll','$key','$value');";
		}

		// print_r($query);

		if($conn->multi_query($query))
		{
			$response_array['status'] = 'success'; 
		}
		else
		{
			$response_array['status'] = 'error'; 
		}
		header('Content-type: application/json');
		echo json_encode($response_array);
	}


 ?>
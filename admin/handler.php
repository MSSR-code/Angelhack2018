<?php 

	require_once ($_SERVER['DOCUMENT_ROOT']."/admin/conn.php");
  	$conn = main_db_connect();
	
	if (isset($_POST['sub_name'])) 
	{
		$sub_name = mysqli_real_escape_string($conn,addslashes($_POST['sub_name']));

		$sql = "INSERT INTO `subject`(`sub_name`) VALUES ('$sub_name')";

		if($conn->query($sql))
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

	else if (isset($_POST['sub_remove'])) 
	{
		$sub_remove = mysqli_real_escape_string($conn,addslashes($_POST['sub_remove']));

		$sql = "DELETE FROM `response` WHERE `sub_id` = '$sub_remove'; DELETE FROM `subject` WHERE `sub_id` = '$sub_remove'";

		if($conn->multi_query($sql))
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

	else if (isset($_POST['form_name'])) 
	{
		$form_name = mysqli_real_escape_string($conn,addslashes($_POST['form_name']));

		$sql = "INSERT INTO `form`(`form_name`, `form_sub`) VALUES ('$form_name','')";

		if($conn->query($sql))
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

	else if (isset($_POST['form']) && isset($_POST['update_sub'])) 
	{
		$form = mysqli_real_escape_string($conn,addslashes($_POST['form']));
		$update_sub = mysqli_real_escape_string($conn,addslashes($_POST['update_sub']));

		$sql = "UPDATE `form` SET `form_sub`='$update_sub' WHERE `form_id` = '$form'";

		if($conn->query($sql))
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

	else if (isset($_POST['form_delete'])) 
	{
		$form = mysqli_real_escape_string($conn,addslashes($_POST['form_delete']));

		$sql = "DELETE FROM `form` WHERE `form_id` = '$form'";

		if($conn->query($sql))
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
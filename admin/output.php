<?php 
	
	require_once ($_SERVER['DOCUMENT_ROOT']."/admin/conn.php");
  	$conn = main_db_connect();

  	if(!isset($_POST['sub_id']))
  	{
  		header("Location: http://localhost:1234");
		die();
  	}

  	$sub_id = $_POST['sub_id'];

	$sql = "SELECT  `roll`, `sub_id`, `response` FROM `response` WHERE `sub_id` = '".$sub_id."'";
	$response = $conn->query($sql);

	$sub = "SELECT `sub_name` FROM `subject` WHERE `sub_id` = '".$sub_id."'";
	$sub_name = $conn->query($sub)->fetch_assoc()['sub_name'];
 ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<div class="container">
		<h4>Legend for the Output of the response form</h4>
		<ol>
			<li>Course/Syllabus Coverage	</li>
			<li>Communication Skills of the Teacher	</li>
			<li>Preperation and Subject Knowledge of the Teacher	</li>
			<li>Punctuality	</li>
			<li>Quality of Assignment/Tutorials	</li>
			<li>Quality of the lecture material notes, slides	</li>
			<li>Interation involvement with the students	</li>
			<li>Coverage beyond the Syllabus	</li>
			<li>Continous evaluation/ quality of the test papers	</li>
			<li>Overall Assessments	</li>
			<li>Class Test papers valued in time (Yes / No)	</li>
			<li>Solutions Discussed (Yes / No)	</li>
			<li>Relanvance of the Prescribed Text books used in the course	</li>
			<li>Quality of the text books prescribed	</li>
			<li>Extent of Learning in this course</li>
		</ol>
			
		<h3 class="text-center">Response for the Subject : <?php echo $sub_name; ?></h3>

		<div class="container">
			 <table style="width: 100%;" class="text-center">
			 	<thead>
			 		<tr>
			 			<td><strong>Roll No.</strong></td>
			 			<td><strong>1</strong></td>
			 			<td><strong>2</strong></td>
			 			<td><strong>3</strong></td>
						<td><strong>4</strong></td>
			 			<td><strong>5</strong></td>
			 			<td><strong>6</strong></td>
			 			<td><strong>7</strong></td>
			 			<td><strong>8</strong></td>
						<td><strong>9</strong></td>
			 			<td><strong>10</strong></td>
			 			<td><strong>11</strong></td>
			 			<td><strong>12</strong></td>
			 			<td><strong>13</strong></td>
						<td><strong>14</strong></td>
			 			<td><strong>15</strong></td>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		<?php 

			 		if($response->num_rows>0)
					{
						while($row = $response->fetch_assoc()) 
						{	
							$resp_array = explode(",", $row['response']);

							?>

							 		<tr>
							 			<td><?php echo $row['roll']; ?></td>
							 			<td><?php echo $resp_array[0] ?></td>
							 			<td><?php echo $resp_array[1] ?></td>
							 			<td><?php echo $resp_array[2] ?></td>
							 			<td><?php echo $resp_array[3] ?></td>
							 			<td><?php echo $resp_array[4] ?></td>
							 			<td><?php echo $resp_array[5] ?></td>
							 			<td><?php echo $resp_array[6] ?></td>
							 			<td><?php echo $resp_array[7] ?></td>
							 			<td><?php echo $resp_array[8] ?></td>
							 			<td><?php echo $resp_array[9] ?></td>
							 			<td><?php echo $resp_array[10] ?></td>
							 			<td><?php echo $resp_array[11] ?></td>
							 			<td><?php echo $resp_array[12] ?></td>
							 			<td><?php echo $resp_array[13] ?></td>
							 			<td><?php echo $resp_array[14] ?></td>
							 		</tr>


							<?php
							   
				        }
					}


			 		 ?>
			 		
			 	</tbody>
			 </table>
		 </div>
</div>
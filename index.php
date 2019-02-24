// this is the first commit

<?php 

	require_once ($_SERVER['DOCUMENT_ROOT']."/admin/conn.php");
  	$conn = main_db_connect();

  	if(!isset($_GET['form']))
  	{
  		die();
  	}

  	$form_id = $_GET['form'];

	$form = "SELECT * FROM `form` WHERE `form_id`='$form_id'";
	$form_res = $conn->query($form);

	$sub_query = "SELECT * FROM `subject` WHERE";

	if($form_res->num_rows>0)
	{
		$form_row = $form_res->fetch_assoc();
		if($form_row['form_sub'])
		{
			$subs = explode(',', $form_row['form_sub']);
		}
		foreach ($subs as $key => $value) 
		{
			$sub_query = $sub_query."`sub_id` = '".$value."' OR";
		}
	}
	else
	{
		die();
	}
	$sub_query .= " 0";

	$sub_array = array();
	$sub_res = $conn->query($sub_query);
	

	$sub_array = array();
	if($sub_res->num_rows>0)
	{
		while($row = $sub_res->fetch_assoc()) 
		{	
			$sub_array[$row['sub_id']] = $row['sub_name'];
			   
        }
	}
	
	function input_elements($input,$subs,$type)
	{
		foreach ($subs as $key => $value) 
		{
			echo '<td><input type="'.$type.'"  class="input_value" data-input="ip_'.$value.'_'.$input.'" ></td>';
		}
	}

	// print_r($sub_array);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Feedback Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
	<style>
		input
		{
			width: 50px;
		}
	</style>

	<h1 class="text-center" style="padding-bottom: 50px;">Feedback Form </h1>

	<h3 class="container" style="margin-top: 20px;margin-bottom: 40px;">Form for <?php echo $form_row['form_name']; ?></h3>

	<div class="container">
		<label for="roll">Roll No.</label>
		<input class="btn" type="number" id="roll" name="roll" style="border: 2px solid #007bff;width:200px;" required>
	</div>

	<div class="container" style="margin:40px auto">
		<table>
			<tbody>
				<?php 
					$i = 1;
					foreach ($sub_array as $key => $value) 
					{
						?>
						<tr>
							<td><?php echo 'Sub '.$i++.':' ?></td>
							<td><strong><?php echo $value ?></strong></td>
						</tr>
							
						<?php
					}

				 ?>
			</tbody>
		</table>
	</div>


	<h5 class="container" style="margin-bottom: 20px;">Please provide the feedback on the subjects on a scale of 1 to 5 with "5 being Excellent" and "1 being Poor".</h5>
	<div class="container">
	<table class="container">
		<thead>
			<td><strong>Assessment</strong></td>
			<?php 

			for ($i=1; $i <= sizeof($sub_array); $i++) 
			{ 
				?>
				<td><strong><?php echo 'Sub '.$i?></strong></td>
				<?php
			}

			 ?>
		</thead>
		<tbody>
			<tr>
				<td>Course/Syllabus Coverage</td>
				<?php input_elements(1,$subs,'number') ?>
			</tr>
			<tr>
				<td>Communication Skills of the Teacher</td>
				<?php input_elements(2,$subs,'number') ?>
			</tr>
			<tr>
				<td>Preperation and Subject Knowledge of the Teacher</td>
				<?php input_elements(3,$subs,'number') ?>
			</tr>
			<tr>
				<td>Punctuality</td>
				<?php input_elements(4,$subs,'number') ?>
			</tr>
			<tr>
				<td>Quality of Assignment/Tutorials</td>
				<?php input_elements(5,$subs,'number') ?>
			</tr>
			<tr>
				<td>Quality of the lecture material notes, slides</td>
				<?php input_elements(6,$subs,'number') ?>
			</tr>
			<tr>
				<td>Interation involvement with the students</td>
				<?php input_elements(7,$subs,'number') ?>
			</tr>
			<tr>
				<td>Coverage beyond the Syllabus</td>
				<?php input_elements(8,$subs,'number') ?>
			</tr>
			<tr>
				<td>Continous evaluation/ quality of the test papers</td>
				<?php input_elements(9,$subs,'number') ?>
			</tr>
			<tr>
				<td>Overall Assessments</td>
				<?php input_elements(10,$subs,'number') ?>
			</tr>
			<tr>
				<td>Class Test papers valued in time (Yes / No)</td>
				<?php input_elements(11,$subs,'text') ?>
			</tr>
			<tr>
				<td>Solutions Discussed (Yes / No)</td>
				<?php input_elements(12,$subs,'text') ?>
			</tr>
			<tr>
				<td>Relanvance of the Prescribed Text books used in the course</td>
				<?php input_elements(13,$subs,'number') ?>
			</tr>
			<tr>
				<td>Quality of the text books prescribed</td>
				<?php input_elements(14,$subs,'number') ?>
			</tr>
			<tr>
				<td>Extent of Learning in this course</td>
				<?php input_elements(15,$subs,'number') ?>
			</tr>
		</tbody>
	</table>
	</div>

	<div class="container text-center" style="margin-top: 50px;margin-bottom: 100px;">
		<div class="btn btn-success" id="submit">Submit Response</div>
	</div>

	<script>
		$('#submit').on('click',function(){
			var response = {};
			$('.input_value').each(function(){
				var ele = $(this).data('input').split('_');
				// console.log('response ' + ele[1] + " " + ele[2]);
				if(response [ele[1]] == undefined)
					response [ele[1]] = '';
				response [ele[1]] += ($(this).val() + ','); 					
			});

			for(var data in response)
			{
				response[data] = response[data].slice(0,-1);		
			}

			var roll = $('#roll').val();

			if(roll != '')
			{
				$.ajax({
					type:'POST',
					url:'response.php',
					data:{'roll':roll,'response':JSON.stringify(response)},
					success : function(data)
					{
						if(data.status == 'success'){
					        alert("Response Sucessfully Updated");
					    }else if(data.status == 'error'){
					        alert("Error on Updating");
					    }
					    location.reload();
					}
				});
			}
			else
				alert('Roll Not Entered');

		});
	</script>

</body>
</html>

<?php 

	require_once ($_SERVER['DOCUMENT_ROOT']."/admin/conn.php");
  	$conn = main_db_connect();

  	$web_url = "http://localhost:1234";

  	if (!isset($_POST['username']) || $_POST['username'] != 'admin' || !isset($_POST['password']) || $_POST['password'] != 'adminece') 
  	{
  		header("Location: ".$web_url."/admin/index.html");
		die();
  	}

  	$sub = "SELECT * FROM `subject` WHERE 1 ORDER BY `sub_id`";
	$sub_res = $conn->query($sub);

	$form = "SELECT * FROM `form` WHERE 1 ORDER BY `form_id`";
	$form_res = $conn->query($form);

	$sub_array = array();
	if($sub_res->num_rows>0)
	{
		while($row = $sub_res->fetch_assoc()) 
		{	
			$sub_array[$row['sub_id']] = $row['sub_name'];
			   
        }
	}
	// print_r($sub_array);


 ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<body>
			<h1 class="text-center">Feedback Form Admin Hub</h1>

			<div class="container" style="margin-top: 50px;">
				
				<h3>Already present Subjects</h3>

				 <select class="btn" style="border: 2px solid #007bff; width:200px;">
				 	<?php 
				 		foreach ($sub_array as $key => $value) 
						{
							echo '<option>'.$value.'</option>';
						}
				 	?>
				 </select>

				<br>

				<div class="container">
					<h3>Add New Subject</h3>
					 <div>
					 	<input class="btn" type="text" id="sub_name" placeholder="Subject Name" style="border: 2px solid #007bff">
					 	<div class="btn btn-success" id="add_new_subject">Add Subject</div>
					 </div>
				</div>
				

			</div>

			<div class="container" style="margin-top: 50px;">
				<h2>Forms</h2>
			
				<h3>Add New Form</h3>

				 <div>
				 	<input class="btn" type="text" id="form_name" placeholder="Form Name" style="border: 2px solid #007bff">
				 	<div class="btn btn-success" id="add_new_form">Add Form</div>
				 </div>

				<?php 

				if($form_res->num_rows>0)
				{
					while($row = $form_res->fetch_assoc()) 
					{	
						
						?>
					
						<div class="form container" style="margin-top: 20px;border: 2px solid #007bff; padding: 20px">
							<h4><?php echo $row['form_name']; ?></h4>
							<h5>Form Link : <a href="<?php echo $web_url."?form=".$row['form_id'] ?>" target="_blank"><?php echo $web_url."?form=".$row['form_id'] ?></a></h5>
							<h6>Click on the subjects below to remove them</h6>
							<ul id="ul_<?php echo $row['form_id']; ?>">
								<?php 

									if($row['form_sub'])
									{
										$subs = explode(',', $row['form_sub']);
										foreach ($subs as $key => $value) 
										{
											echo '<li class="form_sub_li" data-sub="'.$value.'">'.$sub_array[$value].'</li>';
										}
									}


								 ?>	
							</ul>
							<div>
								<select class="btn" id="<?php echo $row['form_id']; ?>" style="border: 2px solid #007bff; width:200px;">
							 		 	<?php 
							 		 		foreach ($sub_array as $key => $value) 
							 				{
							 					echo '<option value="'.$key.'">'.$value.'</option>';
							 				}
							 		 	?>
							 	</select>
								<div class="btn btn-primary form_sub_add" data-form = "<?php echo $row['form_id']; ?>">Add Subject</div>
								<div class="btn btn-primary form_sub_update" data-form = "<?php echo $row['form_id']; ?>">Update Form</div>
								<div class="btn btn-danger form_delete" data-form = "<?php echo $row['form_id']; ?>">Delete Form</div>
							</div>
						</div>


						<?php 

			        }
				}

				 ?>	
			</div>


			<div class="container" style="margin-top: 50px;margin-bottom: 100px;">
				<h3>Forms Response</h3>
				<div class="container">
					<h5>Select Subject to get Response</h5>
					 <div>
					 	<select class="btn" id="sub_response" style="border: 2px solid #007bff; width:200px;">
					 		 	<?php 
					 		 		foreach ($sub_array as $key => $value) 
					 				{
					 					echo '<option value="'.$key.'">'.$value.'</option>';
					 				}
					 		 	?>
					 	</select>
					 	<div class="btn btn-success" id="get_response">Get Response</div>
					 </div>
				</div>
				<div class="container" id="sub_response_ouput" style="margin-top: 50px;">
					
				</div>
			</div>


			 <script>
				
				$('body').on('click','.form_sub_li',function(){
					$(this).remove();
				});

				$('.form_sub_add').on('click',function(){
					var not_present = true;
					var selected_sub = $('#'+$(this).data('form')).val();
					$('#ul_'+$(this).data('form')+' li').each(function(){
							if(selected_sub == $(this).data('sub'))
								not_present = false;
					});

					if(not_present)
						$('#ul_'+$(this).data('form')).append('<li class="form_sub_li" data-sub="'+selected_sub+'">'+$('#'+$(this).data('form')).find('option:selected').text()+'</li>');
					else
						alert("Already Added");
				});
	
				$('.form_sub_update').on('click',function(){
					var data = '';
					var form = $(this).data('form');
					$('#ul_'+form+' li').each(function(){
						data += ($(this).data('sub') + ',');
					});			
					if(data != '')
						data = data.slice(0,-1);		
					
					$.ajax({
							type:'POST',
							url:'handler.php',
							data:{'form':form,'update_sub':data},
							success : function(res)
							{

								if(res.status == 'success'){
							        alert("Form updated");
							    }else if(res.status == 'error'){
							        alert("Error on Updating");
							    }
							    location.reload();
							}
						});

				});

				$('.form_delete').on('click',function(){
					var form = $(this).data('form');
					$.ajax({
							type:'POST',
							url:'handler.php',
							data:{'form_delete':form},
							success : function(res)
							{
								if(res.status == 'success'){
							        alert("Form Deleted");
							    }else if(res.status == 'error'){
							        alert("Error on Deleting");
							    }
							    location.reload();
							}
						});
				});



			 	$('#add_new_subject').on('click',function(){
						$.ajax({
							type:'POST',
							url:'handler.php',
							data:{'sub_name':$('#sub_name').val()},
							success : function(data)
							{

								if(data.status == 'success'){
							        alert("Subject Added");
							    }else if(data.status == 'error'){
							        alert("Error on Adding");
							    }
							    location.reload();
							}
						});
					});

			 	 	$('#add_new_form').on('click',function(){
			 				$.ajax({
			 					type:'POST',
			 					url:'handler.php',
			 					data:{'form_name':$('#form_name').val()},
			 					success : function(data)
			 					{

			 						if(data.status == 'success'){
			 					        alert("Form Added");
			 					    }else if(data.status == 'error'){
			 					        alert("Error on Adding");
			 					    }
			 					    location.reload();
			 					}
			 				});
			 			});

					$('#get_response').on('click',function(){
						$.ajax({
							type:'POST',
							url:'output.php',
							data:{'sub_id':$('#sub_response').val()},
							success : function(data)
							{
								$('#sub_response_ouput').html(data);
							}
						});
					});


			 </script>

</body>
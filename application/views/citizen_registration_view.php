<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		
	<title>DR3MS::Citizen::Registration</title>
	</head>
	
	<body style="overflow-x:none;overflow-y:none;">
		
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('guest_header_view');?>
			</div>
		</div>
		<?php 
			if($user_exist == 1)
			{
				log_message('info','########## USER EXIST');
				foreach($reg_user_info as $user_info):
					$citizen_id = $user_info->citizen_id;
					$gp_name = $user_info->gp_name;
					$circle_name = $user_info->circle_name;
					$block_name = $user_info->block;
					$name = $user_info->name;
					$father_name = $user_info->father_name;
					$contact_no = $user_info->contact_no;
					$village_name = $user_info->village_name;
					$area_locality_street = $user_info->area_locality_street;
					$email_id = $user_info->email_id;
				endforeach; 
			}
			else
			{
				log_message('info','########## NO USER EXIST');
					$citizen_id = '';
					$gp_name = '';
					$circle_name = '';
					$block_name = '';
					$name = '';
					$father_name = '';
					$contact_no = '';
					$village_name = '';
					$area_locality_street = '';
					$email_id = '';
			}
		?>
		<div class = "row" style="margin-top:30px;">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
			<div class="guest-incident-report">
				<div class="container">
					<form class="well form-horizontal" id="citizen_registration_form">
						<fieldset>
							<legend><center><h2><b>Register Here !!</b></h2></center></legend><br>
								<div class="form-group">
									<label class="col-md-4 control-label">Select Circle</label>  
										<div class="col-md-4 inputGroupContainer">
											<!--<select class="form-control" name = "circle_names" id="circle_names"  >
												<option <?php /*if ($user_exist != 1 ) echo 'selected' ; ?> value="Select">Select Circle</option>
														<?php
														foreach($circles as $row)
														{ 
														?>
															<option <?php if ($user_exist == 1 && $circle_name == $row->circle_name ) echo 'selected' ; ?> value="<?php echo $row->circle_name; ?>"><?php echo $row->circle_name; ?></option>
															
														<?php
														}*/
														?>							
											</select>	-->
											<select title="Select Circle" name="circle_names" class="form-control" id="circle_names">      
												<option value="Select">Select Circle</option>
												<?php
												foreach ($circles as $key => $element) {
													//echo //'<option value="'.$element['circle_name'].'">'.$element['circle_name'].'</option>';
													?>
													<option <?php if ($user_exist == 1 && $circle_name == $element['circle_name'] ) echo 'selected' ; ?> value="<?php echo $element['circle_name']; ?>"><?php echo $element['circle_name'] ?></option>
												<?php }
												?>
											</select>
										</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select Block</label> 
									<div class="col-md-4 inputGroupContainer">
										<!--<select class="form-control" name = "block_names" id="block_names" >							
										</select>-->
										<select title="Select Block" name="block_names" class="form-control" id="block_names">      
											<option value="Select">Select Block</option>
										</select>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
										<!--<select class="form-control" name = "gp_names" id="gp_names" >
										</select>-->
										<select title="Select GP" name="gp_names" class="form-control" id="gp_names">      
											<option value="Select">Select GP</option>
										</select>
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Village Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="village" class="form-control" type="text" id="village" value="<?php if($village_name != ''){echo $village_name;} ?>">
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Area/Locality/Street</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="area" class="form-control" type="text" id="area" value="<?php if($area_locality_street != ''){echo $area_locality_street;} ?>">
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="name" class="form-control" type="text" id="name" value="<?php if($name != ''){echo $name;} ?>">
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Father's Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="name_of_father" class="form-control" type="text" id="name_of_father" value="<?php if($father_name != ''){echo $father_name;} ?>">
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Contact No.</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="contact" class="form-control" type="text" id="contact" value="<?php if($contact_no != ''){echo $contact_no;} ?>">
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Email id</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="email" class="form-control" type="text" id="email" placeholder="eg. abc@xyz.com" value="<?php if($email_id != ''){echo $email_id;} ?>">	
										<!--HIDDEN citizen ID FIELD -->
										<input name="citizen_id" class="form-control" type="hidden" id="citizen_id" value="<?php if($citizen_id != ''){echo $citizen_id;} ?>">		
										<!--<div class="result" style="display:none;" id="citizen_id"></div>--->
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickRegister();">Register<span class="glyphicon glyphicon-send"></span></button>
								  </div>
								</div>
								<div class="form-group">
								 <label class="col-md-5 control-label"></label>
								 <div class="col-md-2"><br>
										<button type="button" class="btn btn-danger form-control" onclick="return onClickBack();">BACK</button>
								  </div>
								</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
							
							$(document).ready(function(){
								getBlocksList();								
								$('#circle_names').on('change', function(){
									var circleID = $(this).val();
									if(circleID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Citizen/get_blocks');?>",
											data: {circleID: circleID},
											dataType: 'json',
											beforeSend: function () {
												jQuery('select#block_names').find("option:eq(0)").html("Please wait..");
											},
											success:function(json){										
												var options = '';
												options +='<option value="">Select Block</option>';
												for (var i = 0; i < json.length; i++) {		
													options += '<option value="' + json[i].block + '">' + json[i].block + '</option>';													
												}
												
												jQuery("select#block_names").html(options);
												$('#gp_names').html('<option value="">Select GP</option>'); 
											}
										}); 
									}else{
										$('#block_names').html('<option value="">Select Block</option>');
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
								});
								
								$('#block_names').on('change', function(){
									var blockID = $(this).val();
									if(blockID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Citizen/get_gp');?>",
											data:{blockID: blockID},
											dataType: 'json',
											beforeSend: function () {
												jQuery('select#gp_names').find("option:eq(0)").html("Please wait..");
											},
											success:function(json){
												var options = '';
												options +='<option value="">Select GP</option>';
												for (var i = 0; i < json.length; i++) {
													options += '<option value="' + json[i].gp + '">' + json[i].gp + '</option>';
												}
												jQuery("select#gp_names").html(options);
											}
										}); 
									}else{
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
								});
							});

							function getGPList()
							{
								var blockID = $('#block_names').val();
									if(blockID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Citizen/get_gp');?>",
											data:{blockID: blockID},
											dataType: 'json',
											beforeSend: function () {
												jQuery('select#gp_names').find("option:eq(0)").html("Please wait..");
											},
											success:function(json){
												var options = '';
												options +='<option value="">Select GP</option>';
												for (var i = 0; i < json.length; i++) {
													options += '<option value="' + json[i].gp + '">' + json[i].gp + '</option>';
												}
												jQuery("select#gp_names").html(options);
												document.getElementById('gp_names').value = "<?php echo $gp_name ; ?>"; 	
											}
										}); 
									}else{
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
							}
							
							function getBlocksList()
							{
								var circleID = $('#circle_names').val();
									if(circleID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Citizen/get_blocks');?>",
											data: {circleID: circleID},
											dataType: 'json',
											beforeSend: function () {
												jQuery('select#block_names').find("option:eq(0)").html("Please wait..");
											},
											success:function(json){
												var options = '';
												options +='<option value="">Select Block</option>';
												for (var i = 0; i < json.length; i++) {		
													options += '<option value="' + json[i].block + '">' + json[i].block + '</option>';													
												}
												
												jQuery("select#block_names").html(options);
												document.getElementById('block_names').value = "<?php echo $block_name ; ?>"; 	
												getGPList();
												//$('#gp_names').html('<option value="">Select GP</option>'); 
											}
										}); 
									}else{
										$('#block_names').html('<option value="">Select Block</option>');
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
							}
							/*
							//get Blocks
							jQuery(document).on('change', 'select#circle_names', function (e) {
								e.preventDefault();
								var circleID = jQuery(this).val();
								getBlocksList(circleID);
							});
							// function get All Blocks
							function getBlocksList(circleID) {
								$.ajax({
									url: "<?php echo site_url('Citizen/get_blocks');?>",
									type: 'post',
									data: {circleID: circleID},
									dataType: 'json',
									beforeSend: function () {
										jQuery('select#block_names').find("option:eq(0)").html("Please wait..");
									},
									complete: function () {
										// code
									},
									success: function (json) {
										var options = '';
										options +='<option value="">Select Block</option>';
										for (var i = 0; i < json.length; i++) {
											options += '<option value="' + json[i].block + '">' + json[i].block + '</option>';
										}
										jQuery("select#block_names").html(options);
							 
									}
								});
							}
							// get city
							jQuery(document).on('change', 'select#block_names', function (e) {
								e.preventDefault();
								var blockID = jQuery(this).val();
								getGpList(blockID);
							 
							});
							
							// function get All Cities
							function getGpList(blockID) {
								$.ajax({
									url: "<?php echo site_url('Citizen/get_gp');?>",
									type: 'post',
									data: {blockID: blockID},
									dataType: 'json',
									beforeSend: function () {
										jQuery('select#gp_names').find("option:eq(0)").html("Please wait..");
									},
									complete: function () {
										// code
									},
									success: function (json) {
										var options = '';
										options +='<option value="">Select GP</option>';
										for (var i = 0; i < json.length; i++) {
											options += '<option value="' + json[i].gp + '">' + json[i].gp + '</option>';
										}
										jQuery("select#gp_names").html(options);
							 
									}
								});
							}
							*/

							/*$(document).ready(function()
							{		
								set_block_names();
								
							});	
							function set_block_names()
							{
									var circle_id=$('#circle_names').val();
									
									if(circle_id != 'Select')
									{
											$.ajax({
											
											url : "<?php echo site_url('Guest/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												
												$('#block_names').html(data);
												document.getElementById('block_names').value = "<?php echo $block_name ; ?>";
												set_gp_names();	
											}
											});
									}else
									{
										  $('#block_names').html('<option selected value="Select">Select Block</option>');
										  $('#gp_names').html('<option selected value="Select">Select GP</option>');
									}
							}
							$('#circle_names').change(function(){ 
									set_block_names();	
									set_gp_names();		
							});
							$('#block_names').change(function(){ 
									set_gp_names();	
										
							});
							
							function set_gp_names()
							{
								 var block_id = $('#block_names').val();
									  if(block_id != 'Select')
									  {
									   $.ajax({
										url:"<?php echo site_url('Guest/get_gp');?>",
										method:"POST",
										data:{block_id:block_id},
										success:function(data)
										{
											
										 $('#gp_names').html(data); 
										 document.getElementById('gp_names').value = "<?php echo $gp_name; ?>"; 	
										}
									   });
									  }
									  else
									  {
									   $('#gp_names').html('<option selected value="Select">Select GP</option>');
									  }
								
							}*/
							function onClickRegister()
							{
								validateRegistration();
								
							}
							
							function validateRegistration()
							{

								var selected_circle = $('#circle_names').val();
								var selected_block = $('#block_names').val();
								var selected_gp = $('#gp_names').val();
								
								var name = document.getElementById("name").value; 
								
								var name_of_father = document.getElementById("name_of_father").value;
								
								var contact =  document.getElementById("contact").value;
															
								var village =  document.getElementById("village").value;
								
								var email =  document.getElementById("email").value;
								
								var area =  document.getElementById("area").value;
								
								if(selected_circle == 'Select' || selected_circle == '' || selected_circle == null)
								{
									iqwerty.toast.Toast('Please Select a Circle !!');
									return;
								}
								
								if(selected_block == 'Select' || selected_block == '' || selected_block == null)
								{
									iqwerty.toast.Toast('Please Select a Block !!');
									return;
								}
								
								if(selected_gp == 'Select' || selected_gp == '' || selected_gp == null)
								{
									iqwerty.toast.Toast('Please Select a GP !!');
									return;
								}
								if(name == "")
								{
									iqwerty.toast.Toast('Please Enter Name !!');
									return;
								}
								
								if(name_of_father == "")
								{
									iqwerty.toast.Toast('Please Enter Name of Father !!');
									return;
								}
								
								if(contact == "")
								{
									iqwerty.toast.Toast('Please Enter Contact No. !!');
									return;
								}
								
								if(village == "")
								{
									iqwerty.toast.Toast('Please Enter Address !!');
									return;
								}
								var phonenoformat = /^\d{10}$/;
								if(!contact.match(phonenoformat))
								{
										iqwerty.toast.Toast('You have entered an invalid contact number!');
										return;
								}
								
								var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
								
								if(email != "")
								{
									if(!email.match(mailformat))
									{
										iqwerty.toast.Toast('You have entered an invalid email address!');
										return;
									}
								}
								
								register(selected_circle,selected_block,selected_gp,name,name_of_father,contact,village,email,area);
							}
							function register(selected_circle,selected_block,selected_gp,name,name_of_father,contact,village,email,area)
								{
								$.ajax({
											url:"<?php echo site_url('Citizen/register_citizen');?>",
											method:"POST",
											data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name:name,name_of_father:name_of_father,contact:contact,village:village,email:email,area:area},
											type: "POST",
											cache: false,
											success: function(data){	
												if(data != 0)
												{
													$(".result").html(data);
													iqwerty.toast.Toast('Registered Successfully !!');
													window.location.href="<?php echo base_url('District/');?>";	
												}
												else
												{
													iqwerty.toast.Toast('Internal server error ...Please TRY again!!');
													return;
												}
												
											}

								});
								}
								function onClickBack()
								{
									$.ajax({
											url:"<?php echo site_url('Citizen/logout');?>",
											method:"POST",
											data:{},
											type: "POST",
											cache: false,
											success: function(response)
											{
												window.location.href="<?php echo base_url('District/');?>";																											
											}
										});
								}
				</script>
	</body>
</html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		
	<title>DR3MS::Citizen::Registration</title>
	</head>
	
	<body style="overflow-x:none;overflow-y:none;" >
		
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('dr3ms_header_view');?>
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
				?>
				
				
				
			<?php }
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
		<div class = "row">
		<div class = "col-sm-10">
			<div class="guest-incident-report">
				<div class="container" style="margin-top:50px;">
					<form class="well form-horizontal" id="citizen_registration_form">
						<fieldset>
						<?php 
							if($user_exist == 1)
							{ ?>
								<legend><center><h4>You are already Registered with the details shown below.If you want to edit the details, make the changes and CLICK ON UPDATE</h5></center></legend><br>
								
							<?php 
							}else { ?>	
							<legend><center><h2><b>Register Here !!</b></h2></center></legend><br>
							<?php } ?>
								<div class="form-group">
									<label class="col-md-4 control-label">Select Circle</label>  
										<div class="col-md-4 inputGroupContainer">
											<select title="Select Circle" name="circle_names" class="form-control" id="circle_names">      
												<option value="Select">Select Circle</option>
												<?php
												foreach ($circles as $key => $element) {													
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
										<select title="Select Block" name="block_names" class="form-control" id="block_names">      
											<option value="Select">Select Block</option>
										</select>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
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
								<?php $contact = $this->session->userdata('contact');?>
								<div class="form-group">
							      <label class="col-md-4 control-label">Contact No.</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="contact" class="form-control" type="text" id="contact" value="<?php if($contact_no != ''){echo $contact_no;}else{echo $contact;} ?>" readonly>
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Email id</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="email" class="form-control" type="text" id="email" placeholder="eg. abc@xyz.com" value="<?php if($email_id != ''){echo $email_id;} ?>">	
										<!--HIDDEN citizen ID FIELD -->
										<input name="citizen_id" class="form-control" type="hidden" id="citizen_id" value="<?php if($citizen_id != ''){echo $citizen_id;} ?>">		
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>
								<?php 
									if($user_exist != 1)
									{ ?>
								<div  class="reg-btn-div"  id="reg-btn-div">
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickRegister();">Register<span class="glyphicon glyphicon-send"></span></button>
								  </div>
								</div>
								</div>
								<?php 
									}else{ ?>
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdate();">UPDATE<span class="glyphicon glyphicon-send"></span></button>
								  </div>
								</div>
																
								<?php 
									} ?>								
								</form>
								<form action="<?php echo base_url("Common_Dashboard/load_guest_report_view");?>" method="POST" >
								<div  class="report-incident-btn-div"  id="report-incident-btn-div" style="display:none;">
									<div class="form-group">
									  <label class="col-md-4 control-label"></label>
									  <div class="col-md-4"><br>
										<input type="submit" class="btn btn-info form-control" value="Report an INCIDENT"/>
									  </div>
									</div>
								</div>
								</form>
								<div class="form-group">
								 <label class="col-md-5 control-label"></label>
								 <div class="col-md-2"><br>
										<button type="button" class="btn btn-danger form-control" onclick="return onClickBack();">EXIT</button>
								  </div>
								</div>
						</fieldset>
					
					
				</div>
			</div>
		</div>
		<div class = "col-sm-2">
		</div>
		</div>
		<script type="text/javascript">
							
							$(document).ready(function(){
								<?php 
									if($user_exist == 1)
									{ ?>
									$("#report-incident-btn-div").show();
									<?php  } ?>
				
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
												
											}
										}); 
									}else{
										$('#block_names').html('<option value="">Select Block</option>');
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
							}
							
							function onClickUpdate()
							{
								var selected_circle = $('#circle_names').val();
								var selected_block = $('#block_names').val();
								var selected_gp = $('#gp_names').val();
								
								var citizen_id =  document.getElementById("citizen_id").value;
								
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
																
								
								if(village == "")
								{
									iqwerty.toast.Toast('Please Enter Address !!');
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
								
								$.ajax({
											url:"<?php echo site_url('Citizen/update_citizen_details');?>",
											method:"POST",
											data:{citizen_id:citizen_id,selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name:name,name_of_father:name_of_father,contact:contact,village:village,email:email,area:area},
											type: "POST",
											cache: false,
											success: function(data){	
													if(data != 0)
													{
														iqwerty.toast.Toast('Data Updated Successfully !!');
													}else
													{
														iqwerty.toast.Toast('Updation Failed :: Probable reasons - 1. No fields changed by the User OR 2. Internal Server Error');
														return;
													}
												
											}

								});
								
							}
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
													document.getElementById("citizen_id").value = data ;
													iqwerty.toast.Toast('Registered Successfully !!');
													document.getElementById("circle_names").disabled = true;
													document.getElementById("block_names").disabled = true;
													document.getElementById("gp_names").disabled = true;
													document.getElementById("name").readOnly = true;
													document.getElementById("name_of_father").readOnly = true;
													document.getElementById("contact").readOnly = true;
													document.getElementById("village").readOnly = true;
													document.getElementById("email").readOnly = true;
													document.getElementById("area").readOnly = true;
													$("#reg-btn-div").hide();
													$("#report-incident-btn-div").show();
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
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
											<select class="form-control" name = "circle_names" id="circle_names"  >
												<option value="Select">Select Circle</option>
														<?php
														foreach($circles as $row)
														{ 
														?>
															<option value="<?php echo $row->circle_name; ?>"><?php echo $row->circle_name; ?></option>
															
														<?php
														}
														?>							
											</select>								
										</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select Block</label> 
									<div class="col-md-4 inputGroupContainer">
										<select class="form-control" name = "block_names" id="block_names" >							
										</select>										
									</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
										<select class="form-control" name = "gp_names" id="gp_names" >
										</select>
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Village Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="village" class="form-control" type="text" id="village">
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Area/Locality/Street</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="area" class="form-control" type="text" id="area">
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="name" class="form-control" type="text" id="name">
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Father's Name</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="name_of_father" class="form-control" type="text" id="name_of_father">
									</div>
								</div>
								<div class="form-group">
							      <label class="col-md-4 control-label">Contact No.</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="contact" class="form-control" type="text" id="contact">
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Email id</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="email" class="form-control" type="text" id="email" placeholder="eg. abc@xyz.com">	
										<!--HIDDEN citizen ID FIELD -->
									 <div class="result" style="display:none;" id="citizen_id"></div>
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
							$(document).ready(function()
							{		
								set_block_names();
							});	
							function set_block_names()
							{
									var circle_id=$('#circle_names').val();
									
									if(circle_id != '')
									{
											$.ajax({
											
											url : "<?php echo site_url('Guest/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												
												$('#block_names').html(data);	
												set_gp_names();	
											}
											});
									}else
									{
										  $('#block_names').html('<option value="Select">Select Block</option>');
										  $('#gp_names').html('<option value="Select">Select GP</option>');
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
									  if(block_id != '')
									  {
									   $.ajax({
										url:"<?php echo site_url('Guest/get_gp');?>",
										method:"POST",
										data:{block_id:block_id},
										success:function(data)
										{
										 $('#gp_names').html(data); 		
										}
									   });
									  }
									  else
									  {
									   $('#gp_names').html('<option value="Select">Select GP</option>');
									  }
								
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
								
								if(selected_circle == 'Select')
								{
									iqwerty.toast.Toast('Please Select a Circle !!');
									return;
								}
								
								if(selected_block == 'Select')
								{
									iqwerty.toast.Toast('Please Select a Block !!');
									return;
								}
								
								if(selected_gp == 'Select')
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
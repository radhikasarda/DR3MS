<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		
		<style>
			
			.logoutbutton 
			{
				background-color: #FF0000;
				border: none;
				color: white;
				padding: 0px 20px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 12px;
				margin: 4px 2px;
				cursor: pointer;
			}

		</style>
		<title>DR3MS::Inbox</title>
		
	</head>
	
	<body style="overflow-x:none;overflow-y:none;">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div class = "row" style="margin-right:0px;">
			<div class = "col-sm-6" style = "text-align: left; background-color: #FFB700;height: 25px;">
				<i class="fas fa-user"></i>
				<font color="#000000" size="4">
				"You are logged in as : <?php echo $this->session->userdata('userid'); ;?>" 
				&ensp;
				<i class="fa fa-bell" aria-hidden="true"></i>
				Last Login Time : 	
				<?php foreach((array)$last_login as $last_login){	 
					 echo $last_login->last_login_time;
				}?>
				</font>	
			
	
			</div>
			<div class = "col-sm-6" style = "text-align: right;  height: 25px;background-color: #FFB700;">
				<form action="<?php echo base_url("login/logout");?>">
					<input type="submit" class="logoutbutton" value="LOGOUT">
				</form>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>	
		
		<div class = "row">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
		<div class="incident-report">
			<div class="container">
				<form class="well form-horizontal" action=" " method="post"  id="contact_form">
					<fieldset>
						<legend><center><h2><b>Report An Incident</b></h2></center></legend><br>
							<div class="form-group">
							  <label class="col-md-4 control-label">Select Circle</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
										<select class="form-control" name = "circles" id="circles"  >
											<?php $circle_name = $this->session->userdata('circle_name');
												if($circle_name == 'All'){
												?><option value="All">All</option>
												<?php
												}
											?>										
											<?php
											foreach($circles as $row)
											{
											 echo '<option value="'.$row->circle_name.'">'.$row->circle_name.'</option>';
											}
											?>							
										</select>
									</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select Block</label> 
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
										<select class="form-control" name = "blocks" id="blocks" >							
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select GP</label> 
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
								<select class="form-control" name = "gp" id="gp" >
									<option value="All">All</option>
								</select>
								</div>
							  </div>
							</div>							
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Location/Village Name</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							   <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							  <input  name="location" placeholder="Enter Location/Village Name" class="form-control"  type="text">
								</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Nearest Landmark</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							  <input  name="landmark" placeholder="Enter Nearest Landmark" class="form-control"  type="text">
							</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Latitude</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
							  <input  name="latitude" placeholder="Enter Latitude" class="form-control"  type="text">
							</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Longitude</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
							  <input  name="longitude" placeholder="Enter Longitude" class="form-control"  type="text">
							</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Subject</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
							  <input  name="subject" placeholder="Enter Subject" class="form-control"  type="text">
							</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Incident Date</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							 <input class="form-control" id="datepicker" name="date" placeholder="MM/DD/YYY" type="text"/>
							</div>
							</div>
							</div>
							
							  <div class="form-group"> 
							  <label class="col-md-4 control-label">Department / Office</label>
								<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
								<select name="department" class="form-control selectpicker">
								  <option value="">Select your Department/Office</option>
								  <option>Department of Engineering</option>
								  <option>Department of Agriculture</option>
								  <option >Accounting Office</option>
								  <option >Tresurer's Office</option>
								  <option >MPDC</option>
								  <option >MCTC</option>
								  <option >MCR</option>
								  <option >Mayor's Office</option>
								  <option >Tourism Office</option>
								</select>
							  </div>
							</div>
							</div>
							  
							<!-- Text input-->

							<div class="form-group">
							  <label class="col-md-4 control-label">Username</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							  <input  name="user_name" placeholder="Username" class="form-control"  type="text">
								</div>
							  </div>
							</div>

							<!-- Text input-->

							<div class="form-group">
							  <label class="col-md-4 control-label" >Password</label> 
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							  <input name="user_password" placeholder="Password" class="form-control"  type="password">
								</div>
							  </div>
							</div>

							<!-- Text input-->

							<div class="form-group">
							  <label class="col-md-4 control-label" >Confirm Password</label> 
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							  <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
								</div>
							  </div>
							</div>

							<!-- Text input-->
								   <div class="form-group">
							  <label class="col-md-4 control-label">E-Mail</label>  
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
								</div>
							  </div>
							</div>


							<!-- Text input-->
								   
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No.</label>  
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
							  <input name="contact_no" placeholder="(639)" class="form-control" type="text">
								</div>
							  </div>
							</div>

							<!-- Button -->
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
							  <div class="col-md-4"><br>
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
							  </div>
							</div>

							</fieldset>
							</form>
							</div>
								</div>
		</div>
		<div class = "col-sm-2">
		</div>
		</div>
		
		<script type="text/javascript">
		
				function set_block_names(){
								
								var circle_id=$('#circles').val();
									if(circle_id != '')
									{
											$.ajax({
											url : "<?php echo site_url('Resource_Report/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												$('#blocks').html(data);
												$('#gp').html('<option value="All">All</option>');

											}
											});
									}else
									{
										  $('#blocks').html('<option value="All">All</option>');
										  $('#gp').html('<option value="All">All</option>');
									}
							}
							$(document).ready(function(){
								set_block_names();
								$('#circles').change(function(){ 
									set_block_names();	
										
								}); 
								
								$('#blocks').change(function()
								{
									  var block_id = $('#blocks').val();
									  if(block_id != '')
									  {
									   $.ajax({
										url:"<?php echo site_url('Resource_Report/get_gp');?>",
										method:"POST",
										data:{block_id:block_id},
										success:function(data)
										{
										 $('#gp').html(data);
										}
									   });
									  }
									  else
									  {
									   $('#gp').html('<option value="All">All</option>');
									  }
								});
								
								 $('#datepicker').datepicker({
											uiLibrary: 'bootstrap'
										});									
							});
						</script>
						</script>
	</body>
</html>
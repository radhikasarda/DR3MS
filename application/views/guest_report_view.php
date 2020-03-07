<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
		
	<title>DR3MS::Guest::Incident Report</title>
	</head>
	
	<body style="overflow-x:none;overflow-y:none;" id="guest-report-body">
		
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
		
		<div class="row">
				<?php $this->load->view('dr3ms_header_view');?>		
		</div>
		<?php
			$contact_no = $this->session->userdata('contact');	
			if($user_exist == 1)
			{
				log_message('info','########## USER EXIST');
				foreach($reg_user_info as $user_info):			
					$name = $user_info->name;
					$citizen_id = $user_info->citizen_id;
				endforeach; 
				?>
				
				
				
			<?php }
			else
			{
				log_message('info','########## NO USER EXIST');				
				$name = '';
				$citizen_id = 0;
					
			}
		?>
		<div class = "row" style="margin-top:30px;">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
			<div class="guest-incident-report" id="guest-incident-report">
				<div class="container">
					<form class="well form-horizontal" action="<?php echo base_url("Login/load_citizen_registration_view");?>" method="POST">
						<fieldset>
							<legend><center><h2><b>Report An Incident</b></h2></center></legend><br>
							<?php if($user_exist == 1)
							{ ?>
								<legend><h4><b>You are currently Reporting as:&nbsp; <?php echo $name; ?></b></h4><br>
								If you are not this person, Click on UPDATE button to Update your details!!&ensp;&ensp;&ensp;&ensp;<input type="submit" class="btn btn-info" value="UPDATE" /></form></b></h4></legend><br>
							<?php } ?>
							<form class="well form-horizontal" id="guest_incident_form">
								<div class="form-group">
									<label class="col-md-4 control-label">Select Circle</label>  
										<div class="col-md-4 inputGroupContainer">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
												<select class="form-control" name = "circle_names" id="circle_names"  >
													<option value="Select">Select Circle</option>
														<?php
														foreach($circles as $key => $element)
														{ 
														?>
															<option value="<?php echo $element['circle_name']; ?>"><?php echo $element['circle_name']; ?></option>
															
														<?php
														}
														?>							
												</select>
											<!--HIDDEN CITIZEN ID FIELD -->
											<input name="citizen_id" class="form-control" type="hidden" id="citizen_id" value="<?php echo $citizen_id; ?>">										
											</div>
										</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select Block</label> 
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
											<select class="form-control" name = "block_names" id="block_names" >
												<option value="Select">Select Block</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
											<select class="form-control" name = "gp_names" id="gp_names" >
											<option value="Select">Select GP</option>
											</select>
										</div>
									</div>
								</div>	
								<div class="form-group">
								  <label class="col-md-4 control-label">Location/Village Name</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
											<input  name="location" placeholder="Enter Location/Village Name" class="form-control"  type="text" id="location">
										</div>
									</div>
								</div>							
								<div class="form-group">
							      <label class="col-md-4 control-label">Nearest Landmark</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
											<input  name="landmark" placeholder="Enter Nearest Landmark" class="form-control"  type="text" id="landmark">
										</div>
									</div>
								</div>							
								<div class="form-group">
							      <label class="col-md-4 control-label">Latitude</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
											<input id="latitude" placeholder="Enter Latitude" class="form-control"  type="text">
										</div>
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>						
								<div class="form-group">
								  <label class="col-md-4 control-label">Longitude</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
											<input id="longitude" placeholder="Enter Longitude" class="form-control"  type="text">
										</div>
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>						
								<div class="form-group">
								  <label class="col-md-4 control-label">Subject</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
											<input  name="subject" placeholder="Enter Subject" class="form-control"  type="text" id="subject">
										</div>
									</div>
								</div>						
								<div class="form-group">
								  <label class="col-md-4 control-label">Incident Date</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group" id="datepicker">
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											<input class="form-control" id="date" name="datepicker" placeholder="DD/MM/YYYY" type="text" data-bind="value: startDate, event: {change: savePerishableDate}"/>
										</div>
									</div>
								</div>							
								<div class="form-group">
								  <label class="col-md-4 control-label">Incident Time</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group bootstrap-timepicker">
											<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
											<input id="timepicker" type="text" class="form-control input-small">
										</div>
									</div>
								</div>							
								<div class="form-group">
								  <label class="col-md-4 control-label">Reported By</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											 <input  name="reported_by" placeholder="Enter Name" class="form-control"  type="text" id="reported_by">
										</div>
								  </div>
								</div>		
								<?php $contact = $this->session->userdata('contact');?>
								<div class="form-group">
								  <label class="col-md-4 control-label">Contact No.</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
											<input id="contact_no" class="form-control" type="text" value="<?php echo $contact; ?>" readonly>
										</div>
									</div>
								</div>							
								<div class="form-group">
								  <label class="col-md-4 control-label">Report in Brief</label>  
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
											<textarea class="form-control" id="report_brief" name="report_brief" rows="12" placeholder="Write Report details here.."></textarea>					
											<!--HIDDEN INCIDENT ID FIELD -->
											<div class="result" style="display:none;" id="incident_id"></div> 
										</div>
									</div>
								</div>						
								<div class="form-group">
								  <label class="col-sm-4 control-label">Select First Image</label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
											<input type="file" id="file0" class="form-control" accept='image/jpeg,image/jpg,image/png'>
											<img id="uploaded_img_0" src="#" class="img-thumbnail" alt="No Image" />
											<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
											<button type="button" class="btn btn-danger form-control" id="button_cancel_1" style="display:none;" onclick = "return removeImage1();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
										</div>
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>						
								<div class="form-group">
								  <label class="col-sm-4 control-label">Select Second Image</label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
											<input type="file" id="file1" class="form-control" accept='image/jpeg,image/jpg,image/png'>
											<img id="uploaded_img_1" src="#" class="img-thumbnail" alt="No Image" />
											<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
											<button type="button" class="btn btn-danger form-control" id="button_cancel_2" style="display:none;" onclick = "return removeImage2();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
										</div>
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Select Third Image</label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
											<input type="file" id="file2" class="form-control" accept='image/jpeg,image/jpg,image/png'>
											<img id="uploaded_img_2" src="#" class="img-thumbnail" alt="No Image" />
											<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
											<button type="button" class="btn btn-danger form-control" id="button_cancel_3" style="display:none;" onclick = "return removeImage3();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
										</div>
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>							
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
									<div class="col-md-4"><br>
										<button type="button" class="btn btn-success form-control" onclick="return onClickReportSend();">SEND REPORT<span class="glyphicon glyphicon-send"></span></button>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-md-5 control-label"></label>
									<div class="col-md-2"><br>
										<button type="button" class="btn btn-danger form-control" onclick="return onClickBack();">EXIT</button>
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
		<div class ="row">
			<div class = "col-sm-2">
			</div>
			<div class = "col-sm-8">
				<div class="citizen-registration" id="citizen-registration" style="display:none;">
				<div class="container">
					<form class="well form-horizontal" id="citizen_registration_form">
						<fieldset>						
							<legend><center><h2><b>Register Here !!</b></h2></center></legend><br>							
								<div class="form-group">
									<label class="col-md-4 control-label">Select Circle</label>  
										<div class="col-md-4 inputGroupContainer">
											<select title="Select Circle" name="circle_names" class="form-control" id="circle_names">      
												<option value="Select">Select Circle</option>
												<?php
												foreach ($circles as $key => $element) {													
												?>
													<option value="<?php echo $element['circle_name']; ?>"><?php echo $element['circle_name'] ?></option>
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
								<?php $contact = $this->session->userdata('contact');?>
								<div class="form-group">
							      <label class="col-md-4 control-label">Contact No.</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="contact" class="form-control" type="text" id="contact" value="<?php echo $contact; ?>" readonly>
									</div>
								</div>
								
								<div class="form-group">
							      <label class="col-md-4 control-label">Email id</label>  
									<div class="col-md-4 inputGroupContainer">							 
										<input name="email" class="form-control" type="text" id="email" placeholder="eg. abc@xyz.com" >	
										<!--HIDDEN citizen ID FIELD -->
										<input name="citizen_id" class="form-control" type="hidden" id="citizen_id">		
									</div>
									<label class="control-label"><font color="red"><font size="2">(Optional)</font></font></label>
								</div>
							
								<div  class="reg-btn-div"  id="reg-btn-div">
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickRegister();">Register<span class="glyphicon glyphicon-send"></span></button>
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
		<div class ="row">
			<div class="col-sm-12">
				<?php $this->load->view('footer_view');?>
			</div>
		</div>
		<script type="text/javascript">
							$(document).ready(function()
							{	
									$("#date").datepicker({
									format: "dd/mm/yyyy",
									language: "fr",
									changeMonth: true,
									changeYear: true });
									
									$('#timepicker').timepicker();
									getBlocksList();

									$('#circle_names').on('change', function(){
											var circleID = $(this).val();
											if(circleID){
												$.ajax({
													type:'POST',
													url: "<?php echo site_url('Guest/get_blocks');?>",
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
											url: "<?php echo site_url('Guest/get_gp');?>",
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
							
							function getBlocksList()
							{
								var circleID = $('#circle_names').val();
									if(circleID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Guest/get_blocks');?>",
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
												getGPList();
												
											}
										}); 
									}else{
										$('#block_names').html('<option value="">Select Block</option>');
										$('#gp_names').html('<option value="">Select GP</option>'); 
									}
							}
							
							function getGPList()
							{
								var blockID = $('#block_names').val();
									if(blockID){
										$.ajax({
											type:'POST',
											url: "<?php echo site_url('Guest/get_gp');?>",
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
							}
							
							function removeImage1()
								{
									$('#uploaded_img_0').removeAttr('src');
									$("#file0").val("");
									$("#button_cancel_1").hide();
								}
								function removeImage2()
								{
									$('#uploaded_img_1').removeAttr('src');
									$("#file1").val("");
									$("#button_cancel_2").hide();
								}
								function removeImage3()
								{
									$('#uploaded_img_2').removeAttr('src');
									$("#file2").val("");
									$("#button_cancel_3").hide();
								}
								$(function () {
								$("#file0").change(function () {
											if (this.files && this.files[0]) {
											var reader = new FileReader();
											reader.onload = imageIsLoaded;
											reader.readAsDataURL(this.files[0]);
								}
								});
								function imageIsLoaded(e) {
									$('#uploaded_img_0').attr('src', e.target.result);								
									$("#button_cancel_1").show();
								};
								});

								
								
								$(function () {
								$("#file1").change(function () {
											if (this.files && this.files[0]) {
											var reader = new FileReader();
											reader.onload = imageIsLoaded;
											reader.readAsDataURL(this.files[0]);
								}
								});
								function imageIsLoaded(e) {
									$('#uploaded_img_1').attr('src', e.target.result);
									$("#button_cancel_2").show();
								};
								});

								
								$(function () {
								$("#file2").change(function () {
											if (this.files && this.files[0]) {
											var reader = new FileReader();
											reader.onload = imageIsLoaded;
											reader.readAsDataURL(this.files[0]);
								}
								});
								function imageIsLoaded(e) {
									$('#uploaded_img_2').attr('src', e.target.result);
									$("#button_cancel_3").show();
								};
								});
							function onClickReportSend()
							{
								validateReport();
								
							}
							
							function validateReport()
							{

								var selected_circle = $('#circle_names').val();
								var selected_block = $('#block_names').val();
								var selected_gp = $('#gp_names').val();
								
								
								var latitude = document.getElementById("latitude").value; 
								
								var longitude = document.getElementById("longitude").value;
								
								var location =  document.getElementById("location").value;
															
								var landmark =  document.getElementById("landmark").value;
								
								var subject =  document.getElementById("subject").value;
							
								var incident_date =  document.getElementById("date").value;
							
								var incident_time =  document.getElementById("timepicker").value;
								
								var reported_by =  document.getElementById("reported_by").value;
								
								var contact_no =  document.getElementById("contact_no").value;
								
								var report_brief =  document.getElementById("report_brief").value;
								
								
								var regular_exp = new RegExp("\\([+-]?(90(\\.0+)?|([1-8][0-9]|[1-9])(\\.\\d+)?), [+-]?(180(\\.0+)?|(1[0-7][0-9]|[1-9][0-9]|[1-9])(\\.\\d+)?)\\)");
								
								var phonenoformat = /^\d{10}$/;
								
								if(selected_circle == 'Select' || selected_circle == "" || selected_circle == null)
								{
									iqwerty.toast.Toast('Please Select a Circle !!');
									return;
								}
								
								if(selected_block == 'Select' || selected_block == "" || selected_block == null)
								{
									iqwerty.toast.Toast('Please Select a Block !!');
									return;
								}
								
								if(selected_gp == 'Select' || selected_gp == "" || selected_gp == null)
								{
									iqwerty.toast.Toast('Please Select a GP !!');
									return;
								}
								
								if(latitude != "" && longitude != "")
								{
									var lat_long = "("+latitude+", "+longitude+")";
									if (!regular_exp.test(lat_long)) 
									{
										iqwerty.toast.Toast('Please Enter Valid Latitude And Longitude !!');
										return;
									}
								}
								
								if(location == "")
								{
									iqwerty.toast.Toast('Please Enter Location !!');
									return;
								}
								
								if(landmark == "")
								{
									iqwerty.toast.Toast('Please Enter Landmark !!');
									return;
								}
								
								if(subject == "")
								{
									iqwerty.toast.Toast('Please Enter Subject !!');
									return;
								}
								
								if(incident_date == "")
								{
									iqwerty.toast.Toast('Please Enter Incident Date !!');
									return;
								}
								
								if(incident_time == "")
								{
									iqwerty.toast.Toast('Please Enter Incident Time !!');
									return;
								}
								
								if(reported_by == "")
								{
									iqwerty.toast.Toast('Please Enter Reported By !!');
									return;
								}
								
								if(contact_no == "")
								{
									iqwerty.toast.Toast('Please Enter Contact Number !!');
									return;
								}
								if(!contact_no.match(phonenoformat))
								{
										iqwerty.toast.Toast('You have entered an invalid contact number!');
										return;
								}
								if(report_brief == "")
								{
									iqwerty.toast.Toast('Please Enter Report Details !!');
									return;
								}
								var file1 = document.getElementById('file0').files[0];
								var file2 = document.getElementById('file1').files[0];
								var file3 = document.getElementById('file2').files[0];
								if(file1)
								{
									if(file1.size > 50000)
									{
										iqwerty.toast.Toast('File too Big, Please select a file less than 50kb !!');
										return;
									}
				
								}
								if(file2)
								{
									if(file1.size > 50000)
									{
										iqwerty.toast.Toast('File too Big, Please select a file less than 50kb !!');
										return;
									}
										
								}
								if(file3)
								{
									if(file1.size > 50000)
									{
										iqwerty.toast.Toast('File too Big, Please select a file less than 50kb !!');
										return;
									}										
										
								}			
								var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
								
								if(file1)
								{
									var image1 = document.getElementById('file0');
									var image1Path = image1.value;
									if(!allowedExtensions.exec(image1Path))
									{
											iqwerty.toast.Toast('Please select a PNG/JPG/JPEG file!!');
											return;
									}
								}
								
								if(file2)
								{
									var image2 = document.getElementById('file1');
									var image2Path = image2.value;
									if(!allowedExtensions.exec(image2Path))
									{
											iqwerty.toast.Toast('Please select a PNG/JPG/JPEG file!!');
											return;
									}
								}
								
								if(file3)
								{
									var image3 = document.getElementById('file2');
									var image3Path = image1.value;
									if(!allowedExtensions.exec(image3Path))
									{
											iqwerty.toast.Toast('Please select a PNG/JPG/JPEG file!!');
											return;
									}
								}
														
								var noImage = 0;
								if(!file1 && !file2 && !file3)
								{	
									noImage = 1;
									sendReportWithNoimage(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief);
									
								}																
								else
								{
									sendReportWithImage(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief);																		
								}
								
							}
							
							function uploadImage()
							{		
									var noImage = 0;
									var incident_id = document.getElementById('incident_id').innerHTML;
									
									
									var file1 = document.getElementById('file0').files[0];
									var file2 = document.getElementById('file1').files[0];
									var file3 = document.getElementById('file2').files[0];
								
									var formdata = new FormData();
									if(file1)
									{
										formdata.append('file_1',file1);
									}
									if(file2)
									{
										formdata.append('file_2',file2);
									}
									if(file3)
									{
										formdata.append('file_3',file3);
									}
									
									formdata.append('noImage',noImage);	
									formdata.append('incident_id',incident_id);								
									$.ajax({
										url: "<?php echo site_url('Guest/uploadImage');?>",
										type: 'post',
										data: formdata,
										contentType: false,
										processData: false,
										success: function(data)
										{
												//iqwerty.toast.Toast('Report Sent Successfully !!');
												//window.location.href="<?php echo base_url('District/');?>";	
												check_if_user_registered();
					
										}
									});
									
								}
									
								
												
								
								function sendReportWithImage(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief)
								{
									$.ajax({
												url:"<?php echo site_url('Guest/sendIncidentReport');?>",
												method:"POST",
												data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,latitude:latitude,longitude:longitude,location:location,landmark:landmark,subject:subject,incident_date:incident_date,incident_time:incident_time,reported_by:reported_by,contact_no:contact_no,report_brief:report_brief},
												type: "POST",
												cache: false,
												success: function(data){	
													if(data != 0)
													{												
														$(".result").html(data); 
														uploadImage();
													}
													else
													{
														iqwerty.toast.Toast('Internal server error ...Please TRY again!!');
														return;
													}
													
												}

									});
								}
								
								function sendReportWithNoimage(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief)
								{								
									$.ajax({
												url:"<?php echo site_url('Guest/sendIncidentReport');?>",
												method:"POST",
												data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,latitude:latitude,longitude:longitude,location:location,landmark:landmark,subject:subject,incident_date:incident_date,incident_time:incident_time,reported_by:reported_by,contact_no:contact_no,report_brief:report_brief},
												type: "POST",
												cache: false,
												success: function(data){	
													if(data != 0)
													{												
														$(".result").html(data); 													
														//iqwerty.toast.Toast('Report Sent Successfully!!');
														check_if_user_registered();
														//logout_guest_user();
													}
													else
													{
														iqwerty.toast.Toast('Internal server error ...Please TRY again!!');
														return;
													}
													
												}

									});
								}
								
								function logout_guest_user()
								{
									$.ajax({
											url:"<?php echo site_url('Guest/logout');?>",
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
								function onClickBack()
								{
									$.ajax({
											url:"<?php echo site_url('Guest/logout');?>",
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
						
								function check_if_user_registered()
								{
									var citizen_id = document.getElementById('citizen_id').value;
								
									if(citizen_id == 0)
									{
										
										swal({
										  title: "Report Submitted Successfully",
										  text: "Do you want to Register Youserlf ?",
										  type: "success",
										  showCancelButton: true,
										  confirmButtonClass: "btn-success",
										  confirmButtonText: "Yes, Register",
										  cancelButtonClass: "btn-danger",
										  cancelButtonText: "No, Exit",		 
										  closeOnCancel: false,
										   closeOnConfirm: false
										},
										function(isConfirm) {
										  if (isConfirm) {
											 loadCitizenRegistration();
										  } else {
											logout_guest_user();
										  }
										});										
									}else
									{
										
										swal({
										  title: 'Report Submitted Successfully',
										  text: "Click OK to Exit",										  
										  icon: 'success',
										  showCancelButton: false,
										  confirmButtonClass: "btn-success",
										  confirmButtonText: "Exit",
											closeOnConfirm: false										  
										},
										function(isConfirm) {
										  if (isConfirm) {
											 logout_guest_user();
										  } 
										});	
									}
								}
								
								function loadCitizenRegistration()
								{
									$("#guest-incident-report").hide();	
									$("#citizen-registration").show();										
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
													swal({
													  title: 'Registered Successfully',
													  text: "Click OK to Exit",										  
													  icon: 'success',
													  showCancelButton: false,
													  confirmButtonClass: "btn-success",
													  confirmButtonText: "Exit",										  
													},
													function(isConfirm) {
													  if (isConfirm) {
														 logout_guest_user();
													  } 
													});	
												}
												else
												{
													iqwerty.toast.Toast('Internal server error ...Please TRY again!!');
													return;
												}
												
											}

								});
								}
								
							
		</script>
	</body>
</html>
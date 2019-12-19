<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		
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
		<title>DR3MS::Incident</title>
		
	</head>
	
	<body style="overflow-x:none;overflow-y:none;">
		
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		

		
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div class = "row" style="margin-right:0px;">
			<div class = "col-sm-6" style = "text-align: left; background-color: #FFB700;height: 25px;">
				<i class="glyphicon glyphicon-user"></i>
				<font color="#000000" size="4">
				"You are logged in as : <?php echo $this->session->userdata('userid'); ;?>" 
				&ensp;
				<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
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
				<form class="well form-horizontal" id="contact_form">
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
											?><option value="Select">Select Circle</option>
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
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Longitude</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
							  <input id="longitude" placeholder="Enter Longitude" class="form-control"  type="text">
							</div>
							  </div>
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
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No.</label>  
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
									<input id="contact_no" class="form-control" type="text">
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
									<img id="uploaded_img_0" src="#" alt="No Image" />
									<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
									<button type="button" class="btn btn-danger form-control" id="button_cancel_1" style="display:none;" onclick = "return removeImage1();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
								</div>
							  </div>
							</div>
							
							<div class="form-group">
							    <label class="col-sm-4 control-label">Select Second Image</label>
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
									<input type="file" id="file1" class="form-control" accept='image/jpeg,image/jpg,image/png'>
									<img id="uploaded_img_1" src="#" alt="No Image" />
									<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
									<button type="button" class="btn btn-danger form-control" id="button_cancel_2" style="display:none;" onclick = "return removeImage2();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
								</div>
							  </div>
							</div>
							
							<div class="form-group">
							    <label class="col-sm-4 control-label">Select Third Image</label>
								<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
									<input type="file" id="file2" class="form-control" accept='image/jpeg,image/jpg,image/png'>
									<img id="uploaded_img_2" src="#" alt="No Image" />
									<!--<button type="button" class="btn btn-warning form-control">UPLOAD<span class="glyphicon glyphicon-upload"></span></button>-->
									<button type="button" class="btn btn-danger form-control" id="button_cancel_3" style="display:none;" onclick = "return removeImage3();" >Remove <span class="glyphicon  glyphicon-remove"></span></button>
								</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
							  <div class="col-md-4"><br>
								<button type="button" class="btn btn-success form-control" onclick="return onClickReportSend();">SEND REPORT<span class="glyphicon glyphicon-send"></span></button>
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
		 $('#timepicker').timepicker();
		</script>
		<script type="text/javascript">
		
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

							
							function set_block_names(){
								
								var circle_id=$('#circles').val();
									if(circle_id != '')
									{
											$.ajax({
											url : "<?php echo site_url('Incident/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												$('#blocks').html(data);
												$('#gp').html('<option value="Select">Select GP</option>');

											}
											});
									}else
									{
										  $('#blocks').html('<option value="Select">Select Block</option>');
										  $('#gp').html('<option value="Select">Select GP</option>');
									}
							}
							$(document).ready(function(){
									$("#date").datepicker({
									format: "dd/mm/yyyy",
									language: "fr",
									changeMonth: true,
									changeYear: true });
									
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
										url:"<?php echo site_url('Incident/get_gp');?>",
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
									   $('#gp').html('<option value="Select">Select GP</option>');
									  }
								});
																	
							});
							
							
							function onClickReportSend()
							{
								validateReport();
								
							}
							
							function validateReport()
							{

								var selected_circle = $('#circles').val();
								var selected_block = $('#blocks').val();
								var selected_gp = $('#gp').val();
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
								
								if(report_brief == "")
								{
									iqwerty.toast.Toast('Please Enter Report Details !!');
									return;
								}
																
								sendReport(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief);
							}
							
							function sendReport(selected_circle,selected_block,selected_gp,latitude,longitude,location,landmark,subject,incident_date,incident_time,reported_by,contact_no,report_brief)
							{
								$.ajax({
											url:"<?php echo site_url('Incident/sendIncidentReport');?>",
											method:"POST",
											data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,latitude:latitude,longitude:longitude,location:location,landmark:landmark,subject:subject,incident_date:incident_date,incident_time:incident_time,reported_by:reported_by,contact_no:contact_no,report_brief:report_brief},
											type: "POST",
											cache: false,
											success: function(data){													
												$(".result").html(data); 
												uploadimage();
											}

								});
							}
							
							function uploadimage()
							{								
								var incident_id = document.getElementById('incident_id').innerHTML;
								var formdata = new FormData();
								var file1 = document.getElementById('file0').files[0];
								var file2 = document.getElementById('file1').files[0];
								var file3 = document.getElementById('file2').files[0];
								
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
								
								if(!file1 && !file2 && !file3)
								{
									iqwerty.toast.Toast('Report Sent Successfully!!');
									return;
								}
								else
								{
									formdata.append('incident_id',incident_id);								
									$.ajax({
											url: "<?php echo site_url('Incident/uploadImage');?>",
											type: 'post',
											data: formdata,
											contentType: false,
											processData: false,
											success: function(response)
											{
												iqwerty.toast.Toast('Report Sent Successfully !!');
												window.location.href="<?php echo base_url('Incident/viewIncidents');?>";		
											}
										});
								}								
								
							}	
						</script>
	</body>
</html>
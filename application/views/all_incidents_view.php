<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		<div class= "header-container" id = "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		
		<div class = "row" style="margin-right:0px;" id = "sub-header-container">
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
		
		<div id="navbar-view">
		<?php $this->load->view('navbar_view');?>
		</div>	
		<div class ="row">
		<div class = "col-sm-2">
		</div>
		<div class ="col-sm-8" style="margin-top:-10px;">
			<div id="all-incidents-table-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">                                                                                     
				<table class="table table-striped table-bordered table-hover" id="all-incidents-table">
					<tbody style ="cursor:pointer;">							
						<thead style="background-color: black;color: white;">
							<th style="display:none;"><strong>INCIDENT ID</strong></th>							
							<th><strong>INCIDENT DATE</strong></th>
							<th><strong>INCIDENT TIME</strong></th>
							<th><strong>LOCATION</strong></th>
							<th><strong>SUBJECT</strong></th>
							<th><strong>DETAILS</strong></th>
						</thead>
						<?php foreach((array)$incident as $incident){?>	
						<tr>
							<td class= "incident_id" name ="incident_id" id ="incident_id" style="display:none;"><?=$incident->incident_id;?></td>
							<td class ="incident_date"><?=$incident->incident_date;?></td>
							<td class ="incident_time"><?=$incident->incident_time;?></td>
							<td class ="location"><?=$incident->location_village_name;?></td>
							<td class ="subject"><?=$incident->subject;?></td>
							<td><button onClick="return OnClickViewIncidentDetails();"><strong>View In Detail</strong></button></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
		<div class = "row">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
		<div id="incident-details" class="incident-details" >
		
		</div>
		</div>
		<div class = "col-sm-2">
		</div>
		</div>
		<div class ="row">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8" id="send-instructions" class="send-instructions" style= "display:none;">
		</div>
		</div>
		<!-- FOR IMAGE DISPLAY IN POPUP -->
		<div id="myModal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="img01">
		</div>
		<script>
		window.onload = addRowHandlers();
			function OnClickViewIncidentDetails()
			{
			
			var table = document.getElementById("all-incidents-table");
	
			var rows = table.getElementsByTagName("tr");
			for (i = 0; i < rows.length; i++) {
					var currentRow = table.rows[i];
					var createClickHandler = 
					function(row) 
					{
						return function() {
							
							var id = row.getElementsByClassName("incident_id")[0];
                            var incident_id = id.innerHTML;
							sendRowData(incident_id);
                        };
					};

					currentRow.onclick = createClickHandler(currentRow);
			}
			}
			function sendRowData(incident_id)
			{
			var request_from_incident = "true";
			$.ajax({
											url:"<?php echo site_url('Incident/OnClickViewIncidentDetails');?>",
											method:"POST",
											data:{incident_id:incident_id,request_from_incident:request_from_incident},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#all-incidents-table-div").hide();  
												$("#incident-details").show(); 											
												$('#incident-details').html(data);
												
											}

				});
			}	
			function onClickSendInstructions()
			{
				var incident_id =  document.getElementById("id").value;
				$.ajax({
											url:"<?php echo site_url('Incident/onClickSendInstructions');?>",
											method:"POST",
											data:{incident_id:incident_id},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#all-incidents-table-div").hide();  
												$("#incident-details").hide(); 
												$("#send-instructions").show(); 											
												$('#send-instructions').html(data);
												$('.selectpicker').selectpicker();
												$('.selectpicker').selectpicker('render');
												$('.selectpicker').selectpicker('refresh');
											}

				});			
			}
			
			function onClickSendMessage()
			{
				var recipient_id_list = $('#framework').val().toString();
				var subject = $('#subject_incident').val();
				var msg = $('#message').val();	
				var incident_id = document.getElementById('id').value;
				if(recipient_id_list == ''){
					iqwerty.toast.Toast('Please Select Atleast 1 Recipient !!');
					return;
				}
				if(subject == ''){
					iqwerty.toast.Toast('Please add a Subject !!');	
					return;
				}			
				$.ajax({
											url:"<?php echo site_url('Incident/onSendInstructionMessageClick');?>",
											method:"POST",
											data:{incident_id:incident_id,recipient_id_list:recipient_id_list,subject:subject,msg:msg},
											type: "POST",
											cache: false,
											success: function(response){
													iqwerty.toast.Toast('Instructions Sent Successfully !!');	
													window.location.href="<?php echo base_url('Incident/viewIncidents');?>";	
																							
											},
											error: function() {
												iqwerty.toast.Toast('Internal Server error!! Please Send Again !!');
											}

						});
			}
			function onClickImg1(){
				
				$("#all-incidents-table-div").hide();  
				$("#incident-details").hide();  	
				var modal = document.getElementById("myModal");
				var img = document.getElementById("uploaded_img_0");
				var modalImg = document.getElementById("img01");
	
				modal.style.display = "block";
				modalImg.src = img.src;
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() 
				{ 
				modal.style.display = "none";
				$("#incident-details").show();  	
				}
			}
			
			function onClickImg2(){
				
				$("#all-incidents-table-div").hide();  
				$("#incident-details").hide();  	
				var modal = document.getElementById("myModal");
				var img = document.getElementById("uploaded_img_1");
				var modalImg = document.getElementById("img01");
	
				modal.style.display = "block";
				modalImg.src = img.src;
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() 
				{ 
				modal.style.display = "none";
				$("#incident-details").show();  	
				}
			}
			
			function onClickImg3(){
				
				$("#all-incidents-table-div").hide();  
				$("#incident-details").hide();  	
				var modal = document.getElementById("myModal");
				var img = document.getElementById("uploaded_img_2");
				var modalImg = document.getElementById("img01");
	
				modal.style.display = "block";
				modalImg.src = img.src;
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() 
				{ 
				modal.style.display = "none";
				$("#incident-details").show();  	
				}
			}
		</script>
	</body>
</html>
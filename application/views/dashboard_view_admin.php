<html>
	<head>
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
		<title>DR3MS::Dashboard</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
			
	
	</head>
	<body style="overflow-x:auto;overflow-y:auto;">
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/Chart.js'?>"></script>		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
	<div class= "dashboard-container" >	
		<?php $this->load->view('header_view');?>
		
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>
		<div class="dashboard-body-container" id="dashboard-body-container">
		<div class = "row" style="width:100%;border-style: solid;margin:0px;">
			<div class="col-sm-6" >	
				<div class="chart-container" style="width:100%;">
					<div class="bar-chart-container" style=" width:100%height:100%;">
						<h5 style="text-align:center;"><b><u>Resources Present In each Circle</u></b></h5>
						<canvas id="bar-chart" style="width:100%; height:300px;">
						</canvas>
					</div>
				</div>				
			</div>
			<div class="col-sm-6 "style="border-left: solid;">
				<div class="messages-container" >
					<h5 style="text-align:center;"><b><u>INBOX<u></b></h5>
					<br>
					<div class="container"style="width:100%;height:300px;">                                                                            
						<div class="table-responsive" style="width:100%; height:100%;overflow-x:auto;overflow-y:auto;">          
							<table class="table table-bordered table-hover"  id="all-messages-table">	
							<thead style="background-color: black;color: white;">													
								<tr>
								<th style="display:none;"><strong>MSG ID</strong></th>
								<th><strong>FROM</strong></th>
								<th><strong>SUBJECT</strong></th>
								</tr> 
							</thead>
								<?php foreach((array)$user_msg as $user_msg){?>	
								<tr>
								<td style="display:none;"><?=$user_msg->message_id;?></td>	
								<td><?=$user_msg->msg_from;?></td>
								<td><?=$user_msg->subject;?></td>
								
								</tr>
								<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class = "row" style="width:100%;border-style: solid;margin:0px;">
			<div class="col-sm-6 ">
			<div class="resources-info-container" >
					<h5 style="text-align:center;"><b><u>No. Of Resources In Each Circle<u></b></h5>
					<br>
					
					<div class="container"style="width:100%;height:320px;">                                                                            
						<div class="table-responsive" style="width:100%; height:100%;overflow-x:auto;overflow-y:auto;" >          
							<table class="table table-bordered table-hover"  id="all-resources-table">		
							<thead style="background-color: black;color: white;">													
								<tr>
								<th><strong>Circle</strong></th>
								<?php $user=$this->session->userdata('userid');
								if ($user == "Admin" ||$user == "DC" || $user == "ADC" || $user == "NDRF"){ 
									foreach((array)$circle_info as $circle_info){?>
										<th><strong><?=$circle_info->circle_name;?></strong></th>
								<?php }
									
									
								 } else {?>
									<th><strong><?php echo $this->session->userdata('circle_name');?></strong></th>
								<?php } ?>
								
								</tr> 
							</thead>
								<tr>
									<td><strong>Assets</strong></td>
									<?php foreach((array)$assets_info as $assets_info){?>
										<td><?=$assets_info->no_of_assets;?></td>
									<?php }?> 							
								</tr>   
								<tr>
									<td><strong>Community Halls</strong></td>
									<?php foreach((array)$community_hall_info as $community_hall_info){?>
										<td><?=$community_hall_info->no_of_community_hall;?></td>
									<?php }?> 
								</tr>
								<tr>
									<td><strong>Health Centres</strong></td>
									<?php foreach((array)$health_centre_info as $health_centre_info){?>
										<td><?=$health_centre_info->no_of_health_centre;?></td>
									<?php }?>
								</tr>								
								<tr>
									<td><strong>Institutions</strong></td>
									<?php foreach((array)$institution_info as $institution_info){?>
										<td><?=$institution_info->no_of_institution;?></td>
									<?php }?> 
								</tr>								
								<tr>
									<td><strong>Embankments</strong></td>
									<?php foreach((array)$embankment_info as $embankment_info){?>							
										<td><?=$embankment_info->no_of_embankment;?></td>
									<?php }?>
								</tr>
								<tr>
									<td><strong>Hand Pump & Ring Wells</strong></td>
									<?php foreach((array)$handpump_info as $handpump_info){?>							
										<td><?=$handpump_info->no_of_hand_pump_ring_well;?></td>
									<?php }?>
								</tr>
								<tr>
									<td><strong>Inaccessible Area</strong></td>
									<?php foreach((array)$inaccessible_info as $inaccessible_info){?>							
										<td><?=$inaccessible_info->no_of_inaccessible_area;?></td>
									<?php }?> 
								</tr>
							</table>
						</div>
					</div>
				</div>		
			</div>
			
			<div class="col-sm-6 "  style="border-left: solid;">
			
			<div class="user-info-container"  >
			<h5 style="text-align:center;"><b><u>Recent Incidents<u></b></h5>
			<br>
				<div class="container" style="width:100%;">                                                                            
					<div class="table-responsive" style="width:100%; height:320px;overflow-x:auto;overflow-y:auto;">          
						<table class="table table-bordered table-hover" id="all-incidents-table">
							<thead style="background-color: black;color: white;">
								<tr>
									<th style="display:none;"><strong>INCIDENT ID</strong></th>							
									<th><strong>INCIDENT DATE</strong></th>
									<th><strong>INCIDENT TIME</strong></th>
									<th><strong>LOCATION</strong></th>
									<th><strong>SUBJECT</strong></th>
								</tr> 
							</thead>
							<?php foreach((array)$incident as $incident){?>	
								<tr>
									<td class= "incident_id" name ="incident_id" id ="incident_id" style="display:none;"><?=$incident->incident_id;?></td>
									<td class ="incident_date"><?=$incident->incident_date;?></td>
									<td class ="incident_time"><?=$incident->incident_time;?></td>
									<td class ="location"><?=$incident->location_village_name;?></td>
									<td class ="subject"><?=$incident->subject;?></td>
								</tr>     
							<?php }?>  
						</table>
					</div>
				</div>
			</div>
			<!--<div class="user-info-container"  >
			<h5 style="text-align:center;"><b><u>User Information<u></b></h5>
			<br>
				<div class="container" style="width:100%;">                                                                            
					<div class="table-responsive" style="width:100%; height:320px;overflow-x:auto;overflow-y:auto;">          
						<table class="table table-bordered table-striped" >
							<thead>
								<tr>
									<td><strong>User</strong></td>
									<td><strong>Last Login Time</strong></td>
									<td><strong>Last Login Ip</strong></td>
								</tr> 
							</thead>
							<?php foreach((array)$user_info as $user){?>
								<tr>
									<td><?=$user->user;?></td>
									<td><?=$user->last_login_time;?></td>
									<td><?=$user->last_login_ip;?></td>
								</tr>     
							<?php }?>  
						</table>
					</div>
				</div>
			</div>-->
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
		<div class ="row" id="footer-div">
			<div class="col-sm-12">
				<?php $this->load->view('footer_view');?>
			</div>
		</div>
	</div>
	</body>
	
	<script>
  $(function(){
	  	
	
      //get the bar chart canvas
      var resourcesData = JSON.parse(`<?php echo $resources_chart_data; ?>`);
	
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: resourcesData.circle,
		
        datasets: [
          {
            label: 'No. of Assets',
            data: resourcesData.assets,
            backgroundColor: '#49e2ff',
                               // borderColor: '#46d5f1',
                               // hoverBackgroundColor: '#00008b',
                               // hoverBorderColor: '#666666',
          },
		  {
			label: 'No. of Community Halls',
            data: resourcesData.community_hall,
            backgroundColor: '#A52A2A',
              
		  },
		  {
			label: 'No. of Health Centres',
            data: resourcesData.health_centre,
            backgroundColor: '#00ff00',
                        
		  },
		  {
			label: 'No. of Institutions',
            data: resourcesData.institution,
            backgroundColor: '#800080',
                               
			  
			  
			  
		  }
        ]
      };
 
 
	//options
	var options = {
			scales: {
    xAxes: [{ stacked: true }],
   yAxes: [{ stacked: true }]
    }}
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
		
       //options: options
      });
 
  });
  
  
  
  
  
</script>
<script>
			$(document).ready(function() {
					$('#all-incidents-table').find('tr').click(function () {
						 var incident_id = $(this).find('td:first').text();
						 var request_from_incident = "true";
							$.ajax({
														url:"<?php echo site_url('Incident/OnClickViewIncidentDetails');?>",
														method:"POST",
														data:{incident_id:incident_id,request_from_incident:request_from_incident},
														type: "POST",
														cache: false,
														success: function(data){
															
															$("#dashboard-body-container").hide();  
															$("#footer-div").hide();
															$("#incident-details").show(); 											
															$('#incident-details').html(data);
															
														}

							});
					});
					
			}); 

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
												$("#dashboard-body-container").hide();  
												$("#incident-details").hide();
												$("#footer-div").hide();												
												$("#send-instructions").show(); 											
												$('#send-instructions').html(data);
												$('.selectpicker').selectpicker();
												$('.selectpicker').selectpicker('render');
												$('.selectpicker').selectpicker('refresh');
											}

				});			
			}
			function onClickReset()
			{
				onClickSendInstructions();
			}
			function onClickBack()
			{
				location.reload();
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
				
				$("#dashboard-body-container").hide();  
				$("#incident-details").hide();
				$("#footer-div").hide();		
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
				
				$("#dashboard-body-container").hide();  
				$("#incident-details").hide();
				$("#footer-div").hide(); 	
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
				
				$("#dashboard-body-container").hide();  
				$("#incident-details").hide();
				$("#footer-div").hide(); 	
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
</html>
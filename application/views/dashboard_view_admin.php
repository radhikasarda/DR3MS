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
			.sidebar a {
			    display: block;
			    color: black;
			    padding: 16px;
			    text-decoration: none;
			}
			.sidebar a.active {
				background-color: #000000;
			    color: white;
			}

			.sidebar a:hover:not(.active) {
			  background-color: #555;
			  color: white;
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/Chart.js'?>"></script>				
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		
		<div class= "dashboard-container" >	
			<?php $this->load->view('header_view');?>		
			<div>
				<?php $this->load->view('navbar_view');?>
			</div>
			<div id ="sidebar" class="sidebar" style="margin:0;padding:0;width:200px;background-color:#FFB700;position:absolute;height:100%;margin-top:-20px;display:none;">			
		    <a class="active" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class ="draft" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			</div>	
			<div class="dashboard-body-container" id="dashboard-body-container">
				<div class = "row" style="width:100%;border-style: solid;margin:0px;">
					<div class="col-sm-6" >	
						<div class="chart-container" style="width:100%;">
							<div class="bar-chart-container" style=" width:100%height:100%;">
								<h4 style="text-align:center;"><b><u>Resources Present In each Circle</u></b></h4>
								<canvas id="bar-chart" style="width:100%; height:300px;">
								</canvas>
							</div>
						</div>				
					</div>
					<div class="col-sm-6" style="border-left:solid black;">
						<div class="messages-container" style="width:100%;height:350px;">
							<h4 style="text-align:center;"><b><u>INBOX</u></b></h4>
							<h4><font color="red">Click on Rows for Details !!</font></h4>                                                                      
							<div class="table-responsive" style="overflow-x:auto;overflow-y:auto;height:270px;border:solid black;">          
								<table class="table table-striped table-bordered table-hover"  id="all-messages-table">	
										<thead style="background-color:black;color:white;">													
											<tr>
												<th style="display:none;"><strong>MSG ID</strong></th>
												<th><strong>FROM</strong></th>
												<th><strong>SUBJECT</strong></th>
											</tr> 
										</thead>
										<tbody>
										<?php foreach((array)$user_msg as $user_msg){?>	
										<tr>
											<td class= "msg_id" name ="msg_id" id ="msg_id"  style="display:none;"><?=$user_msg->message_id;?></td>	
											<td class= "msg_from"><?=$user_msg->msg_from;?></td>
											<td class= "subject" ><?=$user_msg->subject;?></td>								
										</tr>
										<?php }?>
										</tbody>
								</table>						
							</div>
						</div>
					</div>
				</div>
		
				<div class = "row" style="width:100%;border-style: solid;margin:0px;">
					<div class="col-sm-6 ">
						<div class="resources-info-container" >
							<h4 style="text-align:center;"><b><u>No. Of Resources In Each Circle</u></b></h4>						
								<div class="container"style="width:100%;">   
									<h4><font color="red">Click on Rows for Details !!</font></h4>     
										<div class="table-responsive" style="height:300px;border:solid black;overflow-x:auto;overflow-y:auto;" >          
											<table class="table table-striped table-bordered table-hover"  id="all-resources-table">		
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
												<tbody>
													<tr>
														<td class= "assets" name ="incident_id" id ="incident_id"><strong>Assets</strong></td>
														<?php foreach((array)$assets_info as $assets_info){?>
															<td><?=$assets_info->no_of_assets;?></td>
														<?php }?> 							
													</tr>   
													<tr>
														<td class= "community_hall"><strong>Community Halls</strong></td>
														<?php foreach((array)$community_hall_info as $community_hall_info){?>
															<td><?=$community_hall_info->no_of_community_hall;?></td>
														<?php }?> 
													</tr>
													<tr>
														<td class= "health_centre"><strong>Health Centres</strong></td>
														<?php foreach((array)$health_centre_info as $health_centre_info){?>
															<td><?=$health_centre_info->no_of_health_centre;?></td>
														<?php }?>
													</tr>								
													<tr>
														<td class= "institution"><strong>Institutions</strong></td>
														<?php foreach((array)$institution_info as $institution_info){?>
															<td><?=$institution_info->no_of_institution;?></td>
														<?php }?> 
													</tr>								
													<tr>
														<td class= "embankment" ><strong>Embankments</strong></td>
														<?php foreach((array)$embankment_info as $embankment_info){?>							
															<td><?=$embankment_info->no_of_embankment;?></td>
														<?php }?>
													</tr>
													<tr>
														<td class= "handpump"><strong>Hand Pump & Ring Wells</strong></td>
														<?php foreach((array)$handpump_info as $handpump_info){?>							
															<td><?=$handpump_info->no_of_hand_pump_ring_well;?></td>
														<?php }?>
													</tr>
													<tr>
														<td class= "inaccessible"><strong>Inaccessible Area</strong></td>
														<?php foreach((array)$inaccessible_info as $inaccessible_info){?>							
															<td><?=$inaccessible_info->no_of_inaccessible_area;?></td>
														<?php }?> 
													</tr>
													</tbody>
												</table>
											</div>
									</div>
							</div>		
					</div>
			
					<div class="col-sm-6 "  style="border-left: solid;">			
						<div class="user-info-container" >
							<h4 style="text-align:center;"><b><u>Recent Incidents</u></b></h4>			
								<div class="container" style="width:100%;">        
									<h4><font color="red">Click on Rows for Details !!</font></h4>      
										<div class="table-responsive" style="height:300px;border:solid black;overflow-x:auto;overflow-y:auto;">          
											<table class="table table-striped table-bordered table-hover" id="all-incidents-table">
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
												<tbody>
													<tr>
														<td class= "incident_id" name ="incident_id" id ="incident_id" style="display:none;"><?=$incident->incident_id;?></td>
														<td class ="incident_date"><?=$incident->incident_date;?></td>
														<td class ="incident_time"><?=$incident->incident_time;?></td>
														<td class ="location"><?=$incident->location_village_name;?></td>
														<td class ="subject"><?=$incident->subject;?></td>
													</tr>
												</tbody>
												<?php }?>  
											</table>
										</div>
								</div>
						</div>
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
		<div class="col-sm-10 "style="margin-top:-10px;margin-left:200px;display:none;" id="message-details">
			<div class ="message-details-container">
				<div class="container"> 
					<div class ="message-details" id ="message-details" >							
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-10" style="margin-top:-10px;margin-left:200px;display:none;" id ="message-forward-reply" >
			<div class ="reply-forward-message-container">					
				<div class ="message-forward-reply" id ="message-forward-reply" >
					<div style='width:100%;'>
						<div class='form-group' style='margin-top:20px;'>
							<textarea class='form-control' rows='10' cols='50' style='overflow-y: scroll;' placeholder= "Write your message here...." id="reply-forward-text"></textarea>
						</div>
						<div class="form-group" >	
							<button type="button" class="btn btn-success" onClick="onClickSendReply();">Send&nbsp;<i class='glyphicon glyphicon-send' aria-hidden='true'></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-10 "style="margin-top:-10px;margin-left:200px;display:none;" id="forward-message-details-div">
			<div id="forward-msg-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">  
				<div class="panel panel-default">
					<div class="panel-body message" id ="forward-message-details" >							
					</div>
				</div>
			</div>
		</div>
		<div class= "row">
			<div class="text-center" >
				<button  id="back-button" type="button"  class="btn btn-primary" onclick="onClickBack();" style="display:none;">BACK</button>
			</div>
		</div>
		<div id ="report-circlewise-all-resource">
			<div class="container" style="overflow-x:auto;overflow-y:auto;">
				<table id ="report-table" class="table table-striped table-bordered">					
				</table>
			</div>
		</div>
		<div id ="detailed-info">			
			<div class="container" style="overflow-x:auto;overflow-y:auto;">				
				<table id ="row-detail-table" class="table table-striped table-bordered" >
				</table>					
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
					$('#all-incidents-table tbody').find('tr').click(function () {
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
					
					$('#all-messages-table tbody').find('tr').click(function () {
						 var msg_id = $(this).find('td:first').text();
							$.ajax({
											url:"<?php echo site_url('Message/onViewRecievedMsgDetailsClick');?>",
											method:"POST",
											data:{msg_id:msg_id},
											type: "POST",
											cache: false,
											success: function(data){	
												$("#dashboard-body-container").hide();  
												$("#footer-div").hide();
												$("#sidebar").show();
												$("#message-details").show(); 											
												$('#message-details').html(data);
												
											}

							});
					});
					
					$('#all-resources-table tbody').find('tr').click(function () {
						 var resource_name = $(this).find('td:first').text();
						 var circle_name = "All";
						 var block_name = "All";
						 var gp_name = "All";
						 
							$.ajax({
											url:"<?php echo site_url('Resource_Report/onClickSubmit');?>",
											method:"POST",
											data:{block_id:block_name,circle_id:circle_name,gp_id:gp_name,resource_id:resource_name},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#dashboard-body-container").hide();  
												$("#footer-div").hide();
												$('#report-table').html(data); 											
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

			function onClickInboxReply()
			{
				$('#buttons').hide();
				$("#message-forward-reply").show(); 	
				$("#reply-forward-text").attr("placeholder", "Write Your REPLY Message Here....");	 			 
			}
			
			function onClickSendReply()
			{							 
				var reply_msg = $('#reply-forward-text').val();
				var parent_message_id = document.getElementById('id').value;
				if(reply_msg == '')
				{
					iqwerty.toast.Toast('Please type a reply message !!');
					return;
				}
				$.ajax({
											url:"<?php echo site_url('Message/onSendReplyClick');?>",
											method:"POST",
											data:{parent_message_id:parent_message_id,reply_msg:reply_msg},
											type: "POST",
											cache: false,
											success: function(data){		
												
												window.location.href="<?php echo base_url('Message/');?>";			
												iqwerty.toast.Toast('Message Sent Successfully !!');	
																				
											},
											error: function() {
												iqwerty.toast.Toast('Internal Server error!! Please Send Again !!');
											}


				});
			}
			
			function onClickInboxForward()
			{
				
				var message_id = document.getElementById('id').value;
				$.ajax({
											url:"<?php echo site_url('Message/onClickInboxForward');?>",
											method:"POST",
											data:{message_id:message_id},
											type: "POST",
											cache: false,
											success: function(data){																
												$("#message-details").hide(); 	
												$("#forward-message-details-div").show(); 	
												$('#forward-message-details').html(data);
												$('.selectpicker').selectpicker();
												$('.selectpicker').selectpicker('render');
												$('.selectpicker').selectpicker('refresh');
																				
											}


				});
			}
			
			function onClickForwardSend()
			{
				var recipient_id_list = $('#framework').val().toString();
				
				var subject = $('#subject').val();
				
				var msg = $('#message').val();	
				
				
				if(recipient_id_list == ''){
					iqwerty.toast.Toast('Please Select Atleast 1 Recipient !!');
					return;
				}
				if(subject == ''){
					iqwerty.toast.Toast('Please add a Subject !!');	
					return;
				}		
				
				var message_id = document.getElementById('id').value;
				
			
				$.ajax({
											url:"<?php echo site_url('Message/onSendForwardMsgClick');?>",
											method:"POST",
											data:{message_id:message_id,recipient_id_list:recipient_id_list,subject:subject,msg:msg},
											type: "POST",
											cache: false,
											success: function(data)
											{																					
												window.location.href="<?php echo base_url('Message/');?>";
												iqwerty.toast.Toast('Message Sent Successfully !!');																
											},
											error: function() {
												iqwerty.toast.Toast('Internal Server error!! Please Send Again !!');
											}

							});
			}
			function onClickViewIncident()
			{
				var incident_id = document.getElementById('inc_id').value;
				var request_from_incident = "false";
				$.ajax({
											url:"<?php echo site_url('Message/onClickViewIncident');?>",
											method:"POST",
											data:{incident_id:incident_id,request_from_incident:request_from_incident},
											type: "POST",
											cache: false,
											success: function(data)
											{														  
												$("#message-details").hide(); 	
												$("#forward-message-details-div").hide();
												$("#sidebar").hide();												
												$("#incident-details").show(); 											
												$('#incident-details').html(data);														
											}

							});
			}
			function onClickBackToInbox()
			{
				window.location.href="<?php echo base_url('Message/');?>";
			}
			function OnClickViewDetails() {
			
				var table = document.getElementById("report-table");
			
					var rows = table.getElementsByTagName("tr");
				
					for (i = 0; i < rows.length; i++) {
							var currentRow = table.rows[i];
							var createClickHandler = 
							function(row) 
							{
								return function() {
									var circle = row.getElementsByClassName("circle")[0];
									var circle_name = circle.innerHTML;
									
									var block = row.getElementsByClassName("block")[0];
									var block_name = block.innerHTML;
									
									var gp = row.getElementsByClassName("gp")[0];
									var gp_name = gp.innerHTML;
				  
									var resource = row.getElementsByClassName("resource")[0];
									var resource_name = resource.innerHTML; 
									
									sendRowData(circle_name,block_name,gp_name,resource_name);
								};
							};

							currentRow.onclick = createClickHandler(currentRow);
					}
				}
				window.onload = addRowHandlers();
 
				function sendRowData(circle_name,block_name,gp_name,resource_name)
				{
					$.ajax({
													url:"<?php echo site_url('Resource_Report/onRowClick');?>",
													method:"POST",
													data:{circle:circle_name,block:block_name,gp:gp_name,resource:resource_name},
													type: "POST",
													cache: false,
													success: function(data){		
														$("#report-circlewise-all-resource").hide();  
														$("#selection-bar").hide(); 
														$("#back-button").show();
														$('#row-detail-table').html(data);
														$('#row-detail-table').show(); 												
													}

									});
				}
				function onClickBack()
				{
					$("#report-circlewise-all-resource").show();  
					$("#back-button").hide();
					$('#row-detail-table').hide(); 
				}
</script>
</html>
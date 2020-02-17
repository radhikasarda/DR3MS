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
		<title>DR3MS::Inbox</title>
		
	</head>
	
	<body style="overflow-x:auto;overflow-y:auto;">
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>	

		<div id ="sidebar" class="sidebar" style="margin:0;padding:0;width:200px;background-color:#FFB700;position:absolute;height:100%;margin-top:-20px;">			
		    <a class="active" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class ="draft" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<!--<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>-->
		</div>
		<?php log_message('info','##########INSIDE message view::noData:: '.$noData); 
							if($noData == 1)
							{
								log_message('info','##########INSIDE message view::noData:: '.$noData);
								?>
								<div class="container"  style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">				
									<div class ="col-md-10" style="margin-left:800px;">
										<div class ="row">	
											<h1>No Data to Display !!</h1>
										</div>
									</div>
								</div>
								<?php }else {	
										$start = $start;
										$end = $end;
										$total_records = $total_records;	
										if($total_records <= $end)
										{
											$end = $total_records;
										}
								?>	
		<div class="container" id="inbox-table-div" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">				
				<div class ="col-md-10" style="margin-top:-30px;margin-left:200px;">
					<div class ="row">								
						<div class="pagination">
							<form method="POST" action="<?php echo base_url("Message/");?>">			
								<button type="submit" class="button" name="submitForm" value="prev" style="margin-top:10px;position: absolute; left: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;"><< Previous</button>
								<button type="submit" class="button" name="submitForm" value="next" style="margin-top:10px;position: absolute; right: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;">Next >></button>
								<input type='hidden' class='form-control select2-offscreen' name='last_end' id='last_end' value='<?php echo $end; ?>'>					 
								<input type='hidden' class='form-control select2-offscreen' name='last_start' id='last_start' value='<?php echo $start; ?>'>
								<br>
							</form>
						</div>
						<h4><?php 
							echo "Showing (".$start."-".$end.") records out of ".$total_records; ?>
						</h4>
						
						<table class="table table-striped table-bordered table-hover" id="recieved-message-table">													
							<thead style="background-color: black;color: white;">
								<tr>
								<th style="display:none;"><strong>MSG ID</strong></th>							
								<th><strong>FROM</strong></th>
								<th><strong>SUBJECT</strong></th>
								<th><strong>DETAILS</strong></th>
								</tr>
							</thead>
							<tbody style ="cursor:pointer;">	
								<?php foreach ($inbox_message as $message) :?>	
								<tr>
								<td class= "msg_id" name ="msg_id" id ="msg_id" style="display:none;"><?=$message->message_id;?></td>
								<td class ="msg_from"><?=$message->msg_from;?></td>
								<td class ="subject"><?=$message->subject;?></td>
								<td><button onClick="return OnClickViewDetails();"><strong>View In Detail</strong></button></td>
								</tr>
								<?php endforeach; 
								log_message('info','##########INSIDE message view::end:: '.$end);?>
							</tbody>
					</table>
					</div>
			</div>
			</div> <?php } ?>	
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
			
			<!-- FOR IMAGE DISPLAY IN POPUP -->
			<div id="myModal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="img01">
			</div>
			<script>
			
			
			window.onload = addRowHandlers();
			function OnClickViewDetails()
			{
			
			var table = document.getElementById("recieved-message-table");
	
			var rows = table.getElementsByTagName("tr");
			for (i = 0; i < rows.length; i++) {
					var currentRow = table.rows[i];
					var createClickHandler = 
					function(row) 
					{
						return function() {
							
							var id = row.getElementsByClassName("msg_id")[0];
                            var msg_id = id.innerHTML;
							sendRowData(msg_id);
                        };
					};

					currentRow.onclick = createClickHandler(currentRow);
			}
			}
			function sendRowData(msg_id)
			{
			$.ajax({
											url:"<?php echo site_url('Message/onViewRecievedMsgDetailsClick');?>",
											method:"POST",
											data:{msg_id:msg_id},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#inbox-table-div").hide();  
												$("#message-details").show(); 											
												$('#message-details').html(data);
												
											}

				});
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
				var incident_id = document.getElementById('inc_id').value;
				$.ajax({
											url:"<?php echo site_url('Message/onClickInboxForward');?>",
											method:"POST",
											data:{message_id:message_id,incident_id:incident_id},
											type: "POST",
											cache: false,
											success: function(data){				
												$("#inbox-table-div").hide();  
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
				var incident_id = document.getElementById('incident_id').value;
			
				$.ajax({
											url:"<?php echo site_url('Message/onSendForwardMsgClick');?>",
											method:"POST",
											data:{message_id:message_id,recipient_id_list:recipient_id_list,subject:subject,msg:msg,incident_id:incident_id},
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
												$("#inbox-table-div").hide();  
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
				$("#incident-details").hide();
				$("#inbox-table-div").hide();  
				$("#sidebar").show();
				$("#message-details").show(); 
			}
			
			function onClickImg1(){
				
				$("#inbox-table-div").hide();  
				$("#message-details").hide(); 	
				$("#forward-message-details-div").hide();
				$("#sidebar").hide();	
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
				
				$("#inbox-table-div").hide();  
				$("#message-details").hide(); 	
				$("#forward-message-details-div").hide();
				$("#sidebar").hide();	
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
				
				$("#inbox-table-div").hide();  
				$("#message-details").hide(); 	
				$("#forward-message-details-div").hide();
				$("#sidebar").hide();	
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
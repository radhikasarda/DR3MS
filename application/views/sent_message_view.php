<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
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
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>	
		<div id ="sidebar" class="sidebar" style="margin:0;padding:0;width:200px;background-color:#FFB700;position:absolute;height:100%;margin-top:-20px;">			
		    <a class="inbox" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="active" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class ="draft" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<!--<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>-->
		</div>
		<?php
			if($noData == 1)
			{ ?>
			<div class="container"  style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">				
				<div class ="col-md-10" style="margin-left:800px;">
					<div class ="row">	
						<h1>No Data to Display !!</h1>
					</div>
				</div>
			</div>
			<?php  } else {						 
					$start = $start;
					$end = $end;
					$total_records = $total_records;	
					if($total_records <= $end)
					{
						$end = $total_records;
					}
					
		?>	
		<div id ="sent-messages-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;"> 
			<div  class="col-md-10" style="margin-top:-30px;margin-left:200px;">			
				<div class ="row">					
						<div class="pagination">
							<form method="POST" action="<?php echo base_url("Message/getSentMsg");?>">			
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
					<table class="table table-striped table-bordered table-hover"  id ="sent-msg-table">
						<thead style ="background-color: black;color: white;">
							<tr>
								<th style="display:none;"><strong>MSG ID</strong></th>	
								<th><strong>Date</strong></th>
								<th><strong>Subject</strong></th>
								<th><strong>Details</strong></th>
							</tr>
						</thead>
						<tbody style ="cursor:pointer;">
						<?php foreach($sent_msg as $message):
						?>
						<tr>
							<td class= "msg_id" name ="msg_id" id ="msg_id" style="display:none;"><?=$message->message_id;?></td>
							<td class = "date"><?=$message->msg_saved_date;?></td>
							<td class = 'subject'><?=$message->subject;?></td>		
							<td><button onClick="return OnClickViewDetails();"><strong>View In Detail</strong></button></td>
							
						</tr>
						<?php endforeach; 
						log_message('info','##########INSIDE sent_msg_view::end:: '.$end); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	<?php } ?>	
		<div class="col-sm-10 "style="margin-top:-10px;margin-left:200px;display:none;" id="message-details">
				<div class ="message-details-container">
					<div class="container"> 
						<div class ="message-details" id ="message-details" >
							
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
		<script>
			window.onload = addRowHandlers();
			function OnClickViewDetails()
			{

			var table = document.getElementById("sent-msg-table");
	
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
											url:"<?php echo site_url('Message/onViewSentMsgDetailsClick');?>",
											method:"POST",
											data:{msg_id:msg_id},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#sent-messages-div").hide();  
												$("#message-details").show(); 											
												$('#message-details').html(data);
												
											}

							});
			}	
			
			function onSentMsgForwardClick()
			{
				var message_id = document.getElementById('id').value;
			
				$.ajax({
											url:"<?php echo site_url('Message/onClickInboxForward');?>",
											method:"POST",
											data:{message_id:message_id},
											type: "POST",
											cache: false,
											success: function(data){				
												$("#sent-messages-div").hide();   
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
		</script>
		</body>
</html>
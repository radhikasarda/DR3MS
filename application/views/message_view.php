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

		<div id ="sidebar" class="sidebar" style="margin:0;padding:0;width:200px;background-color:#FFB700;position:absolute;height:100%;margin-top:-20px;">			
		    <a class="active" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class ="draft" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>
		</div>		
		<div class ="col-sm-10" style="margin-top:-10px;margin-left:200px;">
		<div id="inbox-table-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">                                                                                     
						<table class="table table-striped table-bordered table-hover" id="recieved-message-table">
							<tbody style ="cursor:pointer;">							
							<thead style="background-color: black;color: white;">
								<th style="display:none;"><strong>MSG ID</strong></th>							
								<th><strong>FROM</strong></th>
								<th><strong>SUBJECT</strong></th>
								<th><strong>DETAILS</strong></th>
							</thead>
								<?php foreach((array)$user_msg as $user_msg){?>	
								<tr>
								<td class= "msg_id" name ="msg_id" id ="msg_id" style="display:none;"><?=$user_msg->message_id;?></td>
								<td class ="msg_from"><?=$user_msg->msg_from;?></td>
								<td class ="subject"><?=$user_msg->subject;?></td>
								<td><button onClick="return OnClickViewDetails();"><strong>View In Detail</strong></button></td>
								</tr>
								<?php }?>
							</tbody>
				</table>
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
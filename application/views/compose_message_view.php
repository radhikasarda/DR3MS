<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-select.min.css'?>">
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
		    <a class="inbox" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class ="draft" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="active" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<!--<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>-->
		</div>
		<div class="row">
		<div class = "col-sm-2">
		</div>
		<div class="col-sm-10" style="margin-top:-10px;margin-left:200px;">
			<div id="compose-msg-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">  
					<div class="panel panel-default">
						<div class="panel-body message">
							<form id="myForm" class="form-horizontal" role="form" >
								<div class="form-group" style="padding-left:18px;padding-right:18px;">
									<label for="to" class="col-sm-1 control-label">To:</label>
									<div class="col-sm-11" >
										<form method="post" id="multiple_select_form">
												<select name="framework" id="framework" class="selectpicker form-control " data-live-search="true" multiple>
												<?php
												foreach($users as $user){
												?>
												<option value="<?php echo $user; ?>"><?php echo $user; ?>
												</option>
												<?php
												}
												?>
												</select>
											 <input type="hidden" name="hidden_framework" id="hidden_framework" />
										</form>
									</div>
								</div>
								<div class="form-group" >
								<label for="subject" class="col-sm-1 control-label" style="padding-left:60px;">Subject:</label>
								<div class="col-sm-11">
									<input type="text" class="form-control select2-offscreen" name="subject" id="subject" placeholder="Type subject" >
								</div>
								</div>							  						
							<br>
							<br>
							<br>
							<div class="col-sm-11 col-sm-offset-1">
							<div class="form-group">
								<textarea class="form-control" id="message" name="body" rows="12" placeholder="Write your message here"></textarea>
							</div>
							</div>
							<div class="col-sm-11 col-sm-offset-1">
							<div class="form-group" >	
							<button type="button" class="btn btn-success" onClick="onClickSend();" id="btn-send">Send&nbsp;<i class='glyphicon glyphicon-send' aria-hidden='true'></i></button>
							<button type="button" class="btn btn-default" onClick="onClickDraft();" id="btn-draft">Draft&nbsp;<i class='glyphicon glyphicon-pencil' aria-hidden='true'></i></button>
							<button type="button" class="btn btn-danger" onClick="onClickReset();" id="btn-reset">Reset&nbsp;<i class='glyphicon glyphicon-repeat' aria-hidden='true'></i></button>
							</div>
							</div>
							</form>
					</div>
				</div>
			</div>
			</div>
			</div>
			
			<script>
			$(document).ready(function(){
			$('#framework').selectpicker();
			$('#framework').selectpicker('render');
			$('#framework').selectpicker('refresh');
			
			});			
			function onClickSend()
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
				$.ajax({
											url:"<?php echo site_url('Message/onSendClick');?>",
											method:"POST",
											data:{recipient_id_list:recipient_id_list,subject:subject,msg:msg},
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
			
			function onClickDraft()
			{
				
				var recipient_id_list = $('#framework').val().toString();
				var subject = $('#subject').val();
				var msg = $('#message').val();	
				if(recipient_id_list == '' && subject == '' && msg == '')
				{
					window.location.href="<?php echo base_url('Message/');?>";
				}
				else{
				$.ajax({
											url:"<?php echo site_url('Message/onDraftClick');?>",
											method:"POST",
											data:{recipient_id_list:recipient_id_list,subject:subject,msg:msg},
											type: "POST",
											cache: false,
											success: function(data){
												window.location.href="<?php echo base_url('Message/');?>";
												iqwerty.toast.Toast('Message saved as Draft Successfully !!');													
											},
											error: function() {
												iqwerty.toast.Toast('Internal Server error!! Please SAVE Again !!');
											}

						});
				}			
			}
			
			function onClickReset()
			{
				$("#framework").selectpicker("refresh");
				$("#framework").selectpicker("deselectAll");
				$('#subject').val('');
				$('#message').val('');
			}
			</script>
	</body>
</html>
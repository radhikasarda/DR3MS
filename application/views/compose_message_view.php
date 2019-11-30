<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
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
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		
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
		<div id ="sidebar" class="sidebar" style="margin:0;padding:0;width:200px;background-color:#FFB700;position:absolute;height:100%;margin-top:-20px;">			
		    <a class="inbox" href="<?php echo base_url("Message/");?>"><b><i class="fa fa-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="fa fa-paper-plane" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a href="#draft"><b><i class="fa fa-pen-square" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="active" href="<?php echo base_url("Message/compose");?>"><b><i class="fa fa-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="fa fa-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>
		</div>
		<div class="row">
		<div class = "col-sm-2">
		</div>
		<div class="col-sm-10" style="margin-top:-10px;margin-left:200px;">
			<div class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">  
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
												<option value="<?php echo strtolower($user); ?>"><?php echo $user; ?>
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
							<button type="submit" class="btn btn-success" onClick="onClickSend();">Send&nbsp;<i class='fa fa-paper-plane' aria-hidden='true'></i></button>
							<button type="submit" class="btn btn-default">Draft&nbsp;<i class='fa fa-pen-square' aria-hidden='true'></i></button>
							<button type="button" class="btn btn-danger" onClick="onClickReset();">Reset&nbsp;<i class='fa fa-undo' aria-hidden='true'></i></button>
							</div>
							</div>
							</form>
					</div>
				</div>
			</div>
			</div>
			</div>
			<script>
			function onClickReset()
			{
				$("#framework").selectpicker("deselectAll");
				$('#subject').val('');
				$('#message').val('');
			}
			
			
			function onClickSend()
			{
				if($('#framework').val() == ''){
					alert("Please Select Atleast 1 Recipient");
					return;
				}
				if($('#subject').val() == ''){
					alert("Please add a subject");	
					return;
				}
				
				
				
				
			}
			</script>
	</body>
</html>
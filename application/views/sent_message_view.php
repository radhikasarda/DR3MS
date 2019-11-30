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
			<a class="active" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="fa fa-paper-plane" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a href="#draft"><b><i class="fa fa-pen-square" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="fa fa-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="fa fa-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>
		</div>
		<div  class="col-sm-10" style="margin-top:-10px;margin-left:200px;">
			<div id ="sent-messages-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;"> 
					<table class="table table-striped table-bordered table-hover"  id ="sent-msg-table">
						<tbody style ="cursor:pointer;">
						<thead style ="background-color: black;color: white;">
							<th style="display:none;"><strong>MSG ID</strong></th>	
							<th><strong>Date</strong></th>
							<th><strong>Subject</strong></th>
							<th><strong>Details</strong></th>
						</thead>
						<?php foreach($data_sent_msg as $row)
						{?>
						<tr>
						<td class= "msg_id" name ="msg_id" id ="msg_id" style="display:none;"><?php echo $row['msg_id'];?></td>
						<td class = "date"><?php echo $row['msg_create_date'];?></td>
						<td class = 'subject'><?php echo $row['subject'];?></td>
	
						<td><button onClick="return OnClickViewDetails();"><strong>View In Detail</strong></button></td>
						
						</tr>
						<?php } ?>
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
		</script>
		</body>
</html>
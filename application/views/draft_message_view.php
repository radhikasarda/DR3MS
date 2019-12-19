<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
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
	
	<body id = "body" style="overflow-x:auto;overflow-y:auto;">

		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
			

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
		    <a class="inbox" href="<?php echo base_url("Message/");?>"><b><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i>&ensp;Inbox</b></a>
			<a class="sent" href="<?php echo base_url("Message/getSentMsg");?>"><b><i class="glyphicon glyphicon-send" aria-hidden="true"></i>&ensp;Sent Messages</b></a>
			<a class="active" href="<?php echo base_url("Message/getDraftMsg");?>"><b><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&ensp;Draft Mesages</b></a>
			<a class="compose" href="<?php echo base_url("Message/compose");?>"><b><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&ensp;Compose Message</b></a>
			<a class="bin" href="<?php echo base_url("Message/bin");?>"><b><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>&ensp;Deleted Messages</b></a>
		</div>
		<div  class="col-sm-10" style="margin-top:-10px;margin-left:200px;">
			<div id ="draft-messages-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;"> 
					<table class="table table-striped table-bordered table-hover"  id ="draft-msg-table">
						<tbody style ="cursor:pointer;">
						<thead style ="background-color: black;color: white;">
							<th style="display:none;"><strong>MSG ID</strong></th>	
							<th><strong>Date</strong></th>
							<th><strong>Subject</strong></th>
							<th><strong>Details</strong></th>
						</thead>
						<?php foreach($data_draft_msg as $row)
						{?>
						<tr>
						<td class= "draft_id" name ="draft_id" id ="draft_id" style="display:none;"><?php echo $row['draft_id'];?></td>
						<td class = "date"><?php echo $row['draft_create_date'];?></td>
						<td class = 'subject'><?php echo $row['subject'];?></td>
	
						<td><button onClick="return OnClickViewDetails();"><strong>View In Detail</strong></button></td>
						
						</tr>
						<?php } ?>
						</tbody>
					</table>
			</div>
		</div>		
		<div class="col-sm-10 "style="margin-top:-10px;margin-left:200px;display:none;" id="message-details-div">
				<div id="compose-msg-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">  
					<div class="panel panel-default">
						<div class="panel-body message" id ="message-details" >
							
						</div>
					</div>
				</div>
		</div>
		
						
		<script>
			window.onload = addRowHandlers();
			function OnClickViewDetails()
			{
			
			var table = document.getElementById("draft-msg-table");
	
			var rows = table.getElementsByTagName("tr");
			for (i = 0; i < rows.length; i++) {
					var currentRow = table.rows[i];
					var createClickHandler = 
					function(row) 
					{
						return function() {
									
							var id = row.getElementsByClassName("draft_id")[0];
                            var draft_id = id.innerHTML;
							sendRowData(draft_id);
                        };
					};

					currentRow.onclick = createClickHandler(currentRow);
			}
			}
			function sendRowData(draft_id)
			{
			$.ajax({
											url:"<?php echo site_url('Message/onViewDraftMsgDetailsClick');?>",
											method:"POST",
											data:{draft_id:draft_id},
											type: "POST",
											cache: false,
											success: function(data){	
												$("#draft-messages-div").hide();  
												$("#message-details-div").show(); 	
												$('#message-details').html(data);
												$('.selectpicker').selectpicker();
												$('.selectpicker').selectpicker('render');
												$('.selectpicker').selectpicker('refresh');
											}

							});
			}	
				
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
				
				var draft_id = document.getElementById('id').value;
				
			
				$.ajax({
											url:"<?php echo site_url('Message/onSendDraftMsgClick');?>",
											method:"POST",
											data:{draft_id:draft_id,recipient_id_list:recipient_id_list,subject:subject,msg:msg},
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
			
			function onClickDelete()
			{
				var draft_id = document.getElementById('id').value;
				swal({
					title: "Are you sure?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false			
				  },
				function(isConfirm) {
					if (isConfirm) {
								$.ajax({
											url:"<?php echo site_url('Message/onDeleteDraftMsgClick');?>",
											method:"POST",
											data:{draft_id:draft_id},
											type: "POST",
											cache: false,
											success: function(data)
											{	
												swal("Deleted!", "Your imaginary file has been deleted.", "success");											
												window.location.href="<?php echo base_url('Message/');?>";
												//iqwerty.toast.Toast('Message Deleted Successfully !!');																
											},
											error: function() {
												iqwerty.toast.Toast('Internal Server error!! Please Try Again !!');
											}

							});
					}
				});	
			}
			
		</script>
		</body>
</html>
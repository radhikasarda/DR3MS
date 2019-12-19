<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css"><style>
			
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
		
		<div class ="col-sm-10" style="margin-top:-10px;margin-left:200px;">
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
		
		<div class = "row">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
		<div id="incident-details" class="incident-details" style= "display:none;">
		
		</div>
		</div>
		<div class = "col-sm-2">
		</div>
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
			$.ajax({
											url:"<?php echo site_url('Incident/OnClickViewIncidentDetailsClick');?>",
											method:"POST",
											data:{incident_id:incident_id},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#all-incidents-table-div").hide();  
												$("#incident-details").show(); 											
												$('#incident-details').html(data);
												
											}

				});
			}	
		</script>
	</body>
</html>
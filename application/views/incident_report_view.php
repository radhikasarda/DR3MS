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
		</style>
		<title>DR3MS::Incident Reports</title>
		
		</head>
	
		<body style="overflow-x:auto;overflow-y:auto;">	
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		
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
		<nav class="navbar navbar-inverse" id="selection-bar" style="background-color: #FFB700;margin-top:-20px;">
			<div class="container-fluid">
				<div class="col-sm-12" style="padding-top:8px;">
					<div class="col-xs-3">
						<div class = "row">
						<label>Select Circle:</label>
						</div>
						<div class = "row">				
						<select class="form-control" name = "circles" id="circles"  >
							<?php $circle_name = $this->session->userdata('circle_name');
							if($circle_name == 'All'){
							?><option value="All">All</option>
							<?php
							}
							?>
							
							<?php
							foreach($circles as $row)
							{
							 echo '<option value="'.$row->circle_name.'">'.$row->circle_name.'</option>';
							}
							?>
							
						</select>
						</div>
						<script type="text/javascript">
							
							function set_block_names(){
								
								var circle_id=$('#circles').val();
									if(circle_id != '')
									{
											$.ajax({
											url : "<?php echo site_url('Resource_Report/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												$('#blocks').html(data);
												$('#gp').html('<option value="All">All</option>');

											}
											});
									}else
									{
										  $('#blocks').html('<option value="All">All</option>');
										  $('#gp').html('<option value="All">All</option>');
									}
							}
							$(document).ready(function(){
								set_block_names();
								$('#circles').change(function(){ 
									set_block_names();	
										
								}); 
								
								$('#blocks').change(function()
								{
									  var block_id = $('#blocks').val();
									  if(block_id != '')
									  {
									   $.ajax({
										url:"<?php echo site_url('Resource_Report/get_gp');?>",
										method:"POST",
										data:{block_id:block_id},
										success:function(data)
										{
										 $('#gp').html(data);
										}
									   });
									  }
									  else
									  {
									   $('#gp').html('<option value="All">All</option>');
									  }
								});
																	
							});
						</script>
					</div>
					<div class="col-xs-3">	
						<div class = "row">
						<label>Select Block:</label>
						</div>
						<div class = "row">	
						<select class="form-control" name = "blocks" id="blocks" >
							<option value="All">All</option>
						</select>
						</div>
					</div>
					<div class="col-xs-3">
						<div class = "row">
						<label>Select GP:</label>
						</div>
						<div class = "row">
						<select class="form-control" name = "gp" id="gp" >
							<option value="All">All</option>
						</select>
						</div>
					</div>
					<div class="col-xs-3">
					<button type="button" class="btn btn-primary" onclick="return GetSelectedData();" style="margin-top:25px;">SUBMIT</button>					
					<script>
						function GetSelectedData()
						{
							$.ajax({
											url:"<?php echo site_url('Incident_Report/onClickSubmit');?>",
											method:"POST",
											data:{block_id:$('#blocks').val(),circle_id:$('#circles').val(),gp_id:$('#gp').val(),resource_id:$('#resources').val()},
											type: "POST",
											cache: false,
											success: function(data){												
												$('#incident-report-table').html(data); 
											}

							});

						}				 
					</script>
					</div>
				</div>
			</div>
		</nav>
		<div class= "row" id="back-button" style="display:none;">
				<button type="button"  class="btn btn-primary" onclick="onClickBack();" style="margin-left:900px;margin-bottom:10px;">BACK</button>
		</div>
		<div id ="incident-report-circlewise-all-resource">
			<div class="container">
				<!--<h2>View data</h2>-->
					<table id ="incident-report-table" class="table table-striped table-bordered" >
						
					</table>
			</div>
		</div>
		<div id ="detailed-info">
			
			<div class="container">
				
					<table id ="row-detail-table" class="table table-striped table-bordered" >
						
					</table>
					
			</div>
		</div>
		<script>
		function onClickBack()
		{
			$("#incident-report-circlewise-all-resource").show();  
			$("#selection-bar").show(); 
			$("#back-button").hide();
			$('#row-detail-table').hide(); 
		}
		function OnClickIncidentReportViewDetails()
		{
			var table = document.getElementById("incident-report-table");
	
			var rows = table.getElementsByTagName("tr");
		
			for (i = 0; i < rows.length; i++) {
					var currentRow = table.rows[i];
					var createClickHandler = 
					function(row) 
					{
						return function() {
          
							var incident_id = row.getElementsByClassName("incident_id")[0];
                            var incident_id = incident_id.innerHTML; 
							
							sendRowData(incident_id);
                        };
					};

					currentRow.onclick = createClickHandler(currentRow);
			}
		}
		window.onload = addRowHandlers();
		function sendRowData(incident_id)
		{
			$.ajax({
											url:"<?php echo site_url('Incident_Report/onRowClick');?>",
											method:"POST",
											data:{incident_id:incident_id},
											type: "POST",
											cache: false,
											success: function(data){		
												$("#incident-report-circlewise-all-resource").hide();  
												$("#selection-bar").hide(); 
												$("#back-button").show();
												$('#row-detail-table').html(data);
												$('#row-detail-table').show(); 												
											}

							});
		}
		</script>
		</body>
</html>
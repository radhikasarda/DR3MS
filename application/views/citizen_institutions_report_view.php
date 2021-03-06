<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<title>DR3MS::Institutions Report</title>
		
	</head>
	
	<body style="overflow-x:auto;overflow-y:auto;">
	
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
				
		
		<div class="row">
				<?php $this->load->view('dr3ms_header_view');?>		
		</div>
		
		<nav class="navbar navbar-inverse" id="selection-bar" style="background-color: #FFB700;margin-top:0px;">
			<div class="container-fluid">
				<div class="col-sm-12" style="padding-top:8px;">
					<div class="col-xs-2">
						<div class = "row">
						<label>Select Circle:</label>
						</div>
						<div class = "row">				
						<select class="form-control" name = "circles" id="circles"  >
							<option value="All">All</option>	
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
											url : "<?php echo site_url('Common_DashBoard/get_blocks');?>",
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
										url:"<?php echo site_url('Common_DashBoard/get_gp');?>",
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
					<div class="col-xs-2">	
						<div class = "row">
						<label>Select Block:</label>
						</div>
						<div class = "row">	
						<select class="form-control" name = "blocks" id="blocks" >
							<option value="All">All</option>
						</select>
						</div>
					</div>
					<div class="col-xs-2">
						<div class = "row">
						<label>Select &ensp; GP:</label>
						</div>
						<div class = "row">
						<select class="form-control" name = "gp" id="gp" >
							<option value="All">All</option>
						</select>
						</div>
					</div>
					<div class="col-xs-2">
						<div class = "row">
						<label>Select Resource:</label>
						</div>
						<div class = "row">
						<select class="form-control" name = "resources" id="resources" >
							<option value="Institutions">Institutions</option>											
						</select>
						</div>
					</div>
					<div class="col-xs-2">

					<button type="button" class="btn btn-primary" onclick="return GetSelectedData();" style="margin-top:25px;">SUBMIT</button>					
					<script>
						function GetPreviousData(last_end = null,last_start = null)
						{
							var prev = -1;
							return GetSelectedData(prev,last_end,last_start);
						}
						
						function GetNextData(last_end = null,last_start = null)
						{
							var next = 1;
							return GetSelectedData(next,last_end,last_start);
							
						}
			
						function GetSelectedData(target,last_end = null,last_start = null)
						{
							if(last_end != null)
							{	
								var last_end = document.getElementById('last_end').value;
							}
							if(last_end != null)
							{							
								var last_start = document.getElementById('last_start').value;											
							}
							$.ajax({
											url:"<?php echo site_url('Common_DashBoard/onClickSubmitResource');?>",
											method:"POST",
											data:{block_id:$('#blocks').val(),circle_id:$('#circles').val(),gp_id:$('#gp').val(),resource_id:$('#resources').val(),last_end:last_end,last_start:last_start,target:target},
											type: "POST",
											cache: false,
											success: function(data){
												
												$('#report-circlewise-all-resource').html(data); 
											}

							});
							
						}				 
					</script>
					</div>
				</div>
			</div>
		</nav>
		<div class= "row">
				<div class="text-center" >
				<button  id="back-button" type="button"  class="btn btn-primary" onclick="onClickBack();" style="display:none;margin-top:10px;">BACK</button>
				</div>
		</div>
		<div class="container" id="report-circlewise-all-resource">
			
		</div>
		<form method="POST" action="<?php echo base_url("District/loadCommonDashboard");?>">	
							<div class="form-group" id="btn-back">
							  <label class="col-md-5 control-label"></label>
							  <div class="col-md-2"><br>						
								<button type="submit" class="btn btn-primary btn-block" >BACK TO DASHBOARD</button>
							  </div>
							</div>
		</form>
		<div id ="detailed-info">			
			<div class="container" style="overflow-x:auto;overflow-y:auto;">				
					<table id ="row-detail-table" class="table table-striped table-bordered" >
					</table>					
			</div>
		</div>
		<script>

		function onClickBack()
		{
			$("#report-circlewise-all-resource").show();  
			$("#selection-bar").show();
			$("#btn-back").show();		
			$("#back-button").hide();
			$('#row-detail-table').hide(); 
			
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
							//alert(resource_name);
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
											url:"<?php echo site_url('Common_DashBoard/onRowClick');?>",
											method:"POST",
											data:{circle:circle_name,block:block_name,gp:gp_name,resource:resource_name},
											type: "POST",
											cache: false,
											success: function(data){
																						
												$("#report-circlewise-all-resource").hide();  
												$("#selection-bar").hide(); 
												$("#btn-back").hide();
												
												$("#back-button").show();
												$('#row-detail-table').html(data);
												//$('#row-detail-table').show(); 												
											}

							});
		}
		</script>
	</body>
</html>
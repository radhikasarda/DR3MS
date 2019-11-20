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
		<title>DR3MS::Reports</title>
		
	</head>
	
	<body style="overflow-x:auto;overflow-y:auto;">
	
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>		
		
		<div class= "report-container" >
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
		<nav class="navbar navbar-inverse" style="background-color: #FFB700;margin-top:-20px;">
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
							$(document).ready(function(){

								$('#circles').change(function(){ 
									var circle_id=$('#circles').val();
									if(circle_id != '')
									{
											$.ajax({
											url : "<?php echo site_url('reports/get_blocks');?>",
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
										
								}); 
								
								$('#blocks').change(function()
								{
									  var block_id = $('#blocks').val();
									  if(block_id != '')
									  {
									   $.ajax({
										url:"<?php echo site_url('reports/get_gp');?>",
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
						<label>Select GP:</label>
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
							<option value="All">All</option>
							<?php
							foreach($resources as $row)
							{
							 echo '<option value="'.$row->resource.'">'.$row->resource.'</option>';
							}
							?>						
						</select>
						</div>
					</div>
					<div class="col-xs-2">
					<button type="button" class="btn btn-primary" onclick="return GetSelectedData();">SUBMIT</button>					
					<script>
						function GetSelectedData()
						{
							/*var circle_id=$('#circles').val();
							var block_id=$('#blocks').val();
							var gp_id=$('#gp').val();
							var resource_id=$('#resources').val();
							if(circle_id == '' && block_id == '' && gp_id == '' && resource_id == '')
							{
								document.getElementById('circles').value='All';
								document.getElementById('blocks').value='All';
								document.getElementById('gp').value='All';
								document.getElementById('resources').value='All';
							}*/
							$.ajax({
											url:"<?php echo site_url('reports/onClickSubmit');?>",
											method:"POST",
											data:{block_id:$('#blocks').val(),circle_id:$('#circles').val(),gp_id:$('#gp').val(),resource_id:$('#resources').val()},
											type: "POST",
											cache: false,
											success: function(data){
												//alert(data);
												$('#report-table').html(data); 
											}
											
										
											

											

							});
							$("#report-circlewise-all-resource").show();  
						}				 
					</script>
					</div>
				</div>
			</div>
		</nav>
		<div id ="report-circlewise-all-resource" style="display:none;">
			<div class="container">
				<!--<h2>View data</h2>-->
					<table class="table table-bordered table-sm" >
					<tbody id="report-table">
					  
					</tbody>
					</table>
			</div>
		</div>
		
		
	</body>
</html>
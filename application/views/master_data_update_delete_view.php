<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
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
			
		</style>
		<title>DR3MS::Master Data Update/Delete</title>
		
	</head>
	
	<body style="overflow-x:hidden;overflow-y:auto;">
	
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
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
		<nav class="navbar navbar-inverse" style="background-color: #FFB700;margin-top:-20px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-12" style="padding-top:8px;">	
						<div class="col-sm-2">
						</div>
						<div class="col-sm-8">
							<div class="col-sm-3">
								<div style="margin-top:5px;">
								<label>Select Item:</label>
								</div>
							</div>
							<div class="col-sm-3" style="padding-left:0px;">						
								<select class="form-control" name = "resources" id="resources" >
									<option value="select">--Select--</option>
									<option value="circle">Circle</option>
									<option value="block">Block</option>
									<option value="gp">GP</option>
									<?php
									foreach($resources as $row)
									{
									 echo '<option value="'.$row->resource.'">'.$row->resource.'</option>';
									}
									?>						
								</select>						
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary" onclick="return GetSelectedData();" >SUBMIT</button>		
							</div>				
						</div>
						<div class="col-sm-2">
						</div>
					</div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-inverse" id="selection-bar" style="background-color: #FFFFFF;margin-top:-20px;display:none;">
			<div class="container-fluid">
				<div class="col-sm-12" style="padding-top:8px;">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-2">
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
					<button type="button" class="btn btn-primary" onclick="return GetSelectedCategory();" style="margin-top:25px;">SUBMIT</button>					
					</div>
				</div>
			</div>
		</nav>
		<div id ="master-data-entry-div" style="display:none;">
		</div>
		<div id ="detailed-info" style="display:none;">
			<div class="container" style="overflow-x:auto;overflow-y:auto;height:550px;">
					<table id ="item-detail-table" class="table table-striped table-bordered">					
					</table>
			</div>
		</div>
		
		<script>
			function GetSelectedData()
			{
				if($('#resources').val() == "select")
				{
					iqwerty.toast.Toast('Please SELECT a RESOURCE !!');
					return;	
				}
				if($('#resources').val() == "circle" || $('#resources').val() == "block" || $('#resources').val() == "gp" )
				{
					GetDetailedData();
				}
				else
				{										
						$('#selection-bar').show();
				}
			}	
			function GetDetailedData()
			{
				$.ajax({
											url:"<?php echo site_url('Master_Data_Update_Delete/onClickSubmitArea');?>",
											method:"POST",
											data:{resource_id:$('#resources').val()},
											type: "POST",
											cache: false,
											success: function(data){
												$('#selection-bar').hide();
												$('#item-detail-table').html(data);
												$('#detailed-info').show(); 
												$('#master-data-entry-div').hide();
											}

							});
			}
			
			function GetSelectedCategory()
			{
				$.ajax({
											url:"<?php echo site_url('Master_Data_Update_Delete/onClickSubmitResource');?>",
											method:"POST",
											data:{block_id:$('#blocks').val(),circle_id:$('#circles').val(),gp_id:$('#gp').val(),resource_id:$('#item').val()},
											type: "POST",
											cache: false,
											success: function(data){
												$('#detailed-data-table').html(data); 
											}

							});
			}
			
			function OnClickEdit()
			{
				var table = document.getElementById("item-detail-table");
	
				var rows = table.getElementsByTagName("tr");
			
				for (i = 0; i < rows.length; i++) {
						var currentRow = table.rows[i];
						var createClickHandler = 
						function(row) 
						{
							return function() {
								var id_row = row.getElementsByClassName("id")[0];
								var id = id_row.innerHTML;
								sendRowData(id);
							};
						};

						currentRow.onclick = createClickHandler(currentRow);
				}
			}
				window.onload = addRowHandlers();
 
			function sendRowData(id)
			{
				var selected_item = $('#resources').val()
				$.ajax({
												url:"<?php echo site_url('Master_Data_Update_Delete/getItemDetails');?>",
												method:"POST",
												data:{id:id,selected_item:selected_item},
												type: "POST",
												cache: false,
												success: function(data)
												{													
													$('#detailed-info').hide(); 
													$('#master-data-entry-div').show();
													$('#master-data-entry-div').html(data); 
												}

								});
			}
			
			function OnClickDelete()
			{
				alert("hii");
			}
			function onClickAddCircleData()
			{
				var name_of_circle = document.getElementById("name_of_circle").value; 
				
				if(name_of_circle == '')
				{
					iqwerty.toast.Toast('Some Fields are Missing !!');
					return;	
				}
				else
				{
					$.ajax({
								url:"<?php echo site_url('Master_data/onClickAddCircleData');?>",
								method:"POST",
								data:{name_of_circle:name_of_circle},
								type: "POST",
								cache: false,
								success: function(data)
								{
									if(data == 1)
									{
										iqwerty.toast.Toast('Data Inserted Successfully !!');
										$('#master-data-entry-div').hide();
										getDetailedData();
									}
									else									
									{
										iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
									}
								}

				});	
				}
			}
			function onClickAddBlockData()
			{
				var selected_circle = $('#circles').val();
				var name_of_block = document.getElementById("name_of_block").value; 
				
				if(name_of_block == '' || selected_circle == 'select' )
				{
					iqwerty.toast.Toast('Some Fields are Missing !!');
					return;	
				}
				
				else
				{
					$.ajax({
									url:"<?php echo site_url('Master_data/onClickAddBlockData');?>",
									method:"POST",
									data:{selected_circle:selected_circle,name_of_block:name_of_block},
									type: "POST",
									cache: false,
									success: function(data)
									{
										if(data == 1)
										{
											iqwerty.toast.Toast('Data Inserted Successfully !!');
											$('#master-data-entry-div').hide();
											getDetailedData();
										}
										else									
										{
											iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
										}
									}

					});	
				}			
			}
		</script>
	</body>
</html>

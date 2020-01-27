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
		<title>DR3MS::Registered Citizens</title>
		
	</head>
	
	<body style="overflow-x:none;overflow-y:none;">
		
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		
		<div class= "header-container" id = "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>

		<div id="navbar-view">
		<?php $this->load->view('navbar_view');?>
		</div>	
		
				<div class ="row">
		<div class = "col-sm-2">
		</div>
		<div class ="col-sm-8" style="margin-top:-10px;">
			<div id="registered-citizens-table-div" class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">                                                                                     
				<table class="table table-striped table-bordered table-hover" id="registered-citizens-table">
					<tbody style ="cursor:pointer;">							
						<thead style="background-color: black;color: white;">
									<td><strong>Citizen ID</strong></td>
									<td><strong>Circle Name</strong></td>
									<td><strong>Block Name</strong></td>
									<td><strong>GP Name</strong></td>
									<td><strong>Citizen Name</strong></td>
									<td><strong>Father's Name</strong></td>
									<td><strong>Contact No.</strong></td>
									<td><strong>Village</strong></td>
									<td><strong>Area/Locality/Street</strong></td>
									<td><strong>Email ID</strong></td>
						</thead>
						<?php foreach((array)$data_reg_citizen_details as $citizen){?>
								<tr>
									<td><?php echo $citizen['citizen_id']; ?></td>
									<td><?php echo $citizen['circle']; ?></td>
									<td><?php echo $citizen['block']; ?></td>
									<td><?php echo $citizen['gp']; ?></td>
									<td><?php echo $citizen['name']; ?></td>
									<td><?php echo $citizen['father_name']; ?></td>
									<td><?php echo $citizen['contact_no']; ?></td>
									<td><?php echo $citizen['village_name']; ?></td>
									<td><?php echo $citizen['area_locality_street']; ?></td>
									<td><?php echo $citizen['email_id']; ?></td>
									
								</tr>     
						<?php }?>  
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</body>
</html>
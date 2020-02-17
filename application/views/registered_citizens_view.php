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
	
	<body style="overflow-x:auto;overflow-y:auto;">
		
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
		<?php
			if($noData == 1)
			{ ?>
			<div class="container">
				<div class ="row">
					<div class ="col-md-12" style="margin-left:400px;">
						<div class ="row">	
							<h1>No Data to Display !!</h1>
						</div>
					</div>
				</div>
			</div>
			<?php  } else {						 
					$start = $start;
					$end = $end;
					$total_records = $total_records;	
					if($total_records <= $end)
					{
						$end = $total_records;
					}
					
		?>	
		<div class="container">
			<div class ="row">
				<div class ="col-md-12">
					<div class="row">
						<form method="POST" action="<?php echo base_url("Dashboard/viewRegisteredCitizens");?>">						
						<div class="pagination">
						<button type="submit" class="button" name="submitForm" value="prev" style="margin-top:10px;position: absolute; left: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;"><< Previous</button>
						<button type="submit" class="button" name="submitForm" value="next" style="margin-top:10px;position: absolute; right: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;">Next >></button>
						<input type='hidden' class='form-control select2-offscreen' name='last_end' id='last_end' value='<?php echo $end; ?>'>					 
						<input type='hidden' class='form-control select2-offscreen' name='last_start' id='last_start' value='<?php echo $start; ?>'>	
						<br>
						</form>
						</div>			
						<h4><?php 
							echo "Showing (".$start."-".$end.") records out of ".$total_records; ?>
						</h4>
						<table class="table table-striped table-bordered table-hover" id="registered-citizens-table">													
								<thead style="background-color: black;color: white;">
											<td><strong>Sl No.</strong></td>
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
								<tbody style ="cursor:pointer;">	
								<?php $counter =  $start;
								foreach ($citizen as $citizen) :?>
										<tr>
											<td><?php echo $counter; ?></td>
											<td><?= $citizen->circle_name ?></td>
											<td><?= $citizen->block ?></td>
											<td><?= $citizen->gp_name ?></td>
											<td><?= $citizen->name ?></td>
											<td><?= $citizen->father_name ?></td>
											<td><?= $citizen->contact_no ?></td>
											<td><?= $citizen->village_name ?></td>
											<td><?= $citizen->area_locality_street ?></td>
											<td><?= $citizen->email_id ?></td>
										</tr>     
								<?php $counter ++;
								endforeach; 
								log_message('info','##########INSIDE reg_citizen_view::end:: '.$end);?> 													
							</tbody>
						</table>
					</div>
				</div>	
			</div>
			</div> <?php } ?>
	</body>
</html>
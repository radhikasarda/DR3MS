<html>
	<head>
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
		<title>DR3MS::Dashboard</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
			
	
	</head>
	<body style="overflow-x:auto;overflow-y:auto;">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>				
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>		
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<div class= "dashboard-container" >
	
		<?php $this->load->view('header_view');?>
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
		<div class="dashboard-body-container" >
		<div class = "row" style="width:100%;border-style: solid;margin:0px;">
			<div class="col-sm-6" >	
				<div class="chart-container" style="width:100%;">
					<div class="bar-chart-container" style=" width:100%height:100%;">
						<h5 style="text-align:center;"><b><u>Resources Present In each Circle</u></b></h5>
						<canvas id="bar-chart" style="width:100%; height:300px;">
						</canvas>
					</div>
				</div>				
			</div>
			<div class="col-sm-6 "style="border-left: solid;">
				<div class="messages-container" >
					<h5 style="text-align:center;"><b><u>INBOX<u></b></h5>
					<br>
					<div class="container"style="width:100%;height:300px;">                                                                            
						<div class="table-responsive" style="width:100%; height:100%;overflow-x:auto;overflow-y:auto;">          
							<table class="table table-bordered table-hover"  >	
							<thead style="background-color: black;color: white;">													
								<tr>
								<th><strong>FROM</strong></th>
								<th><strong>SUBJECT</strong></th>
								</tr> 
							</thead>
								<?php foreach((array)$user_msg as $user_msg){?>	
								<tr>
									
								<td><?=$user_msg->msg_from;?></td>
								<td><?=$user_msg->subject;?></td>
								
								</tr>
								<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class = "row" style="width:100%;border-style: solid;margin:0px;">
			<div class="col-sm-6 ">
			<div class="resources-info-container" >
					<h5 style="text-align:center;"><b><u>No. Of Resources In Each Circle<u></b></h5>
					<br>
					
					<div class="container"style="width:100%;height:320px;">                                                                            
						<div class="table-responsive" style="width:100%; height:100%;overflow-x:auto;overflow-y:auto;">          
							<table class="table table-bordered table-hover"  >		
							<thead style="background-color: black;color: white;">													
								<tr>
								<th><strong>Circle</strong></th>
								<?php $user=$this->session->userdata('userid');
								if ($user == "Admin" ||$user == "DC" || $user == "ADC" || $user == "NDRF"){ 
									foreach((array)$circle_info as $circle_info){?>
										<th><strong><?=$circle_info->circle_name;?></strong></th>
								<?php }
									
									
								 } else {?>
									<th><strong><?php echo $this->session->userdata('circle_name'); ;?></strong></th>
								<?php } ?>
								
								</tr> 
							</thead>
								<tr>
									<td><strong>Assets</strong></td>
									<?php foreach((array)$assets_info as $assets_info){?>
										<td><?=$assets_info->no_of_assets;?></td>
									<?php }?> 							
								</tr>   
								<tr>
									<td><strong>Community Halls</strong></td>
									<?php foreach((array)$community_hall_info as $community_hall_info){?>
										<td><?=$community_hall_info->no_of_community_hall;?></td>
									<?php }?> 
								</tr>
								<tr>
									<td><strong>Health Centres</strong></td>
									<?php foreach((array)$health_centre_info as $health_centre_info){?>
										<td><?=$health_centre_info->no_of_health_centre;?></td>
									<?php }?>
								</tr>								
								<tr>
									<td><strong>Institutions</strong></td>
									<?php foreach((array)$institution_info as $institution_info){?>
										<td><?=$institution_info->no_of_institution;?></td>
									<?php }?> 
								</tr>								
								<tr>
									<td><strong>Embankments</strong></td>
									<?php foreach((array)$embankment_info as $embankment_info){?>							
										<td><?=$embankment_info->no_of_embankment;?></td>
									<?php }?>
								</tr>
								<tr>
									<td><strong>Hand Pump & Ring Wells</strong></td>
									<?php foreach((array)$handpump_info as $handpump_info){?>							
										<td><?=$handpump_info->no_of_hand_pump_ring_well;?></td>
									<?php }?>
								</tr>
								<tr>
									<td><strong>Inaccessible Area</strong></td>
									<?php foreach((array)$inaccessible_info as $inaccessible_info){?>							
										<td><?=$inaccessible_info->no_of_inaccessible_area;?></td>
									<?php }?> 
								</tr>
							</table>
						</div>
					</div>
				</div>		
			</div>
			
			<div class="col-sm-6 "  style="border-left: solid;">
			<?php 		
			$user=$this->session->userdata('userid');
			if ($user == "Admin" ||$user == "DC"){  
			?>			
			<div class="user-info-container"  >
			<h5 style="text-align:center;"><b><u>User Information<u></b></h5>
			<br>
				<div class="container" style="width:100%;">                                                                            
					<div class="table-responsive" style="width:100%; height:320px;overflow-x:auto;overflow-y:auto;">          
						<table class="table table-bordered table-hover" >
							<thead style="background-color: black;color: white;">
								<tr>
									<td><strong>User</strong></td>
									<td><strong>Last Login Time</strong></td>
									<td><strong>Last Login Ip</strong></td>
								</tr> 
							</thead>
							<?php foreach((array)$user_info as $user){?>
								<tr>
									<td><?=$user->user;?></td>
									<td><?=$user->last_login_time;?></td>
									<td><?=$user->last_login_ip;?></td>
								</tr>     
							<?php }?>  
						</table>
					</div>
				</div>
			</div><?php }
			else {
			?>	
			<!--<div class="user-info-container"  >
			<h5 style="text-align:center;"><b><u>User Information<u></b></h5>
			<br>
				<div class="container" style="width:100%;">                                                                            
					<div class="table-responsive" style="width:100%; height:320px;overflow-x:auto;overflow-y:auto;">          
						<table class="table table-bordered table-striped" >
							<thead>
								<tr>
									<td><strong>User</strong></td>
									<td><strong>Last Login Time</strong></td>
									<td><strong>Last Login Ip</strong></td>
								</tr> 
							</thead>
							<?php foreach((array)$user_info as $user){?>
								<tr>
									<td><?=$user->user;?></td>
									<td><?=$user->last_login_time;?></td>
									<td><?=$user->last_login_ip;?></td>
								</tr>     
							<?php }?>  
						</table>
					</div>
				</div>
			</div>--><?php 
				}
				?>
			</div>
		</div>
		</div>
	
		<div class ="row">
			<div class="col-sm-12">
				<?php $this->load->view('footer_view');?>
			</div>
		</div>
	
	
	
	</div>
	</body>
	
	<script>
  $(function(){
	  	
	
      //get the bar chart canvas
      var resourcesData = JSON.parse(`<?php echo $resources_chart_data; ?>`);
	
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: resourcesData.circle,
		
        datasets: [
          {
            label: 'No. of Assets',
            data: resourcesData.assets,
            backgroundColor: '#49e2ff',
                               // borderColor: '#46d5f1',
                               // hoverBackgroundColor: '#00008b',
                               // hoverBorderColor: '#666666',
          },
		  {
			label: 'No. of Community Halls',
            data: resourcesData.community_hall,
            backgroundColor: '#A52A2A',
              
		  },
		  {
			label: 'No. of Health Centres',
            data: resourcesData.health_centre,
            backgroundColor: '#00ff00',
                        
		  },
		  {
			label: 'No. of Institutions',
            data: resourcesData.institution,
            backgroundColor: '#800080',
                               
			  
			  
			  
		  }
        ]
      };
 
 
	//options
	var options = {
			scales: {
    xAxes: [{ stacked: true }],
   yAxes: [{ stacked: true }]
    }}
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
		
       //options: options
      });
 
  });
  
  
  
  
  
</script>

</html>
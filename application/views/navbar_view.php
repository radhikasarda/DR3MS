
			<style>
			
			.navbar a:hover {
				background-color: #000;
			}
			</style>
			
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="<?php echo base_url("Dashboard/");?>">Dashboard</a>
					</div>
					<ul class="nav navbar-nav">
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url("Master_Data/");?>"><b>Master Data</b><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url("Master_Data/");?>"><b>Entry</b></a></li>
								<li><a href="<?php echo base_url("Master_Data_Update_Delete/");?>"><b>Edit/Delete</b></a></li>
							</ul>
						</li>
						<li><a href="<?php echo base_url("Resource_Report/");?>"><b>Resources Report</b></a></li>
						<!--<li><a href="<?php echo base_url("Master_Data/");?>"><b>Master Data</b></a></li> -->
						<li><a href="<?php echo base_url("Message/");?>"><b>Message</b></a></li>
						<li><a href="<?php echo base_url("Incident/");?>"><b>Report An Incident</b></a></li>
						<li><a style="color:#FFB700;" href="<?php echo base_url("Incident/viewIncidents");?>"><b>RECENT INCIDENTS</b></a></li>
						<li><a href="<?php echo base_url("Password/loadChangePasswordView");?>"><b>Change Password</b></a></li>
						<?php $user = $this->session->userdata('userid');
						if($user =='Admin')
						{?>
						<li><a href="<?php echo base_url("Dashboard/viewUserInfo");?>"><b>User Information</b></a></li>
						<?php } ?>
					</ul>
				</div>
			</nav>	

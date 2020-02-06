
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
						
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><b>INCIDENT</b><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url("Incident/");?>"><b>Report An Incident</b></a></li>
								<li><a href="<?php echo base_url("Incident/viewIncidents");?>"><b>RECENT INCIDENTS</b></a></li>
							</ul>
						</li>
						
						<li><a href="<?php echo base_url("Resource_Report/");?>"><b>RESOURCES REPORT</b></a></li>
						<li><a href="<?php echo base_url("Message/");?>"><b>MESSAGE</b></a></li>
						
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><b>MASTER DATA</b><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url("Master_Data/");?>"><b>Entry</b></a></li>
								<li><a href="<?php echo base_url("Master_Data_Update_Delete/");?>"><b>Edit/Delete</b></a></li>
							</ul>
						</li>
						<?php $user = $this->session->userdata('userid');
						if($user =='Admin')
						{?>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><b>ADMIN</b><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url("Dashboard/viewUserInfo");?>"><b>User Information</b></a></li>
								<li><a href="<?php echo base_url("Dashboard/viewRegisteredCitizens");?>"><b>Registered Citizens</b></a></li>
								<li><a href="<?php echo base_url("Password/loadChangePasswordView");?>"><b>Change Your Password</b></a></li>
								<li><a href="<?php echo base_url("Password/loadResetPasswordView");?>"><b>Reset User Password</b></a></li>
								<li><a href="<?php echo base_url("Audit_Trail/");?>"><b>Audit Trail</b></a></li>
							</ul>
						</li>					
						<?php } else {?>
						
						<li><a href="<?php echo base_url("Password/loadChangePasswordView");?>"><b>CHANGE PASSWORD</b></a></li>
						
						<?php } ?>
					</ul>
				</div>
			</nav>	

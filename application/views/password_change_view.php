<html>
	<head>
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
		<title>DR3MS::Password Change</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
			
	
	</head>
	<body style="overflow-x:auto;overflow-y:auto;">
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>
		
		<div class = "row">
		<div class = "col-sm-2">
		</div>
		<div class = "col-sm-8">
		<div class="password-change">
			<div class="container">
				<form class="well form-horizontal" id="password_change_form" action="<?php echo base_url("Password/changePassword");?>"  method="POST">
					<fieldset>
						<legend><center><h2><b></b></h2></center></legend><br>					
							<div class="form-group">
							  <label class="col-md-4 control-label">Enter Current Password</label>  
								<div class="col-md-4 inputGroupContainer">								
									<input  name="current_password"  class="form-control" minlength="5"  maxlength="5"  pattern="[0-9]+" type="text" id="current_password" required>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Enter New Password</label>  
								<div class="col-md-4 inputGroupContainer">								
									<input  name="new_password"  class="form-control"   minlength="5"  maxlength="5"  pattern="[0-9]+" type="password" id="new_password" required>
									<label class="control-label"><font color="red"><font size="2">Maximum 5 digits allowed(Use only numbers)</font></font></label>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Retype New Password</label>  
								<div class="col-md-4 inputGroupContainer">								
									<input  name="retype_password"  class="form-control"  minlength="5" maxlength="5"  pattern="[0-9]+" type="password" id="retype_password" required>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="submit" class="btn btn-success form-control">Change Password</button>
							  </div>
							</div>
					</fieldset>
				</form>
			</div>
		</div>
		</div>
		</div>					
		<script>
		
		</script>
	</body>
</html>
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
		<title>DR3MS::Password Reset</title>
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
		<div class="password-reset">
			<div class="container">
				<form class="well form-horizontal" id="password_reset_form" action="<?php echo base_url("Password/resetPassword");?>"  method="POST">
					<fieldset>
						<legend><center><h2><b>Reset Password</b></h2></center></legend><br>					
							<div class="form-group">
							  <label class="col-md-4 control-label">Select User</label>  
								<div class="col-md-4 inputGroupContainer">								
									<select name = "users" id="users" class="form-control">
												<option value="select">Select User </option>
												<?php
												foreach($users as $user){
												?>
												
												<option value="<?php echo $user; ?>"><?php echo $user; ?>
												</option>
												<?php
												}
												?>
									</select>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Enter Your Password</label>  
								<div class="col-md-4 inputGroupContainer">								
									<input  name="password"  class="form-control" type="password" id="password" >
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="submit" class="btn btn-success form-control" onClick="return onClickReset();">Reset Password</button>
							  </div>
							</div>
					</fieldset>
				</form>
			</div>
		</div>
		</div>
		</div>					
		<script>
			function onClickReset()
			{
				var user = document.getElementById('users').value;
				
				if(user == 'select')
				{
					iqwerty.toast.Toast("Select a User !!");
					return false;
				}
			
				var password = document.getElementById('password').value;
				
				if(password == '')
				{
					iqwerty.toast.Toast("Please Enter Password !!");
					return false;
				}
				
				document.getElementById('password_reset_form').submit();
				return true;
			}
		
			
			<?php if($this->session->flashdata('PasswordError')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('PasswordError'); ?>");
			<?php } else if($this->session->flashdata('setPasswordError')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('setPasswordError'); ?>");
			<?php } else if($this->session->flashdata('passwordResetSuccess')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('passwordResetSuccess'); ?>");
			<?php } ?>
		</script>
	</body>
</html>
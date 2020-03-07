<!--<html>
	<head>
	 <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php //echo base_url().'assets/css/toast.css'?>" type="text/css">
	<style>
				body{
				margin: 0;
				padding: 0;
				background: url(<?php// echo base_url("assets/img/Login_bg.jpg");?>);
				background-size: cover;
				background-position: center;
				font-family: sans-serif;
			}
			
			.login-box{
				width: 320px;
				height: 430px;
				background: rgba(0, 0, 0, 0.5);
				color: #fff;
				top: 43%;
				left: 50%;
				position: absolute;
				transform: translate(-50%,-50%);
				box-sizing: border-box;
				padding: 70px 30px;
			}
			.avatar{
				width: 100px;
				height: 100px;
				border-radius: 50%;
				position: absolute;
				top: -50px;
				left: calc(50% - 50px);
			}
	
			.login-box p{
				margin: 0;
				padding: 0;
				font-weight: bold;
			}
			.login-box input{
				width: 100%;
				margin-bottom: 20px;
			}
			.login-box input[type="text"], input[type="password"]
			{
				border: none;
				border-bottom: 1px solid #fff;
				background: transparent;
				outline: none;
				height: 40px;
				color: #fff;
				font-size: 16px;
			}
			.login-box input[type="submit"]
			{
				border: none;
				outline: none;
				height: 40px;
				background: #1c8adb;
				color: #fff;
				font-size: 18px;
				border-radius: 20px;
			}
			.login-box input[type="submit"]:hover
			{
				cursor: pointer;
				background: #39dc79;
				color: #000;
			}

			.login-box a{
				text-decoration: none;
				font-size: 14px;
				color: #fff;
			}
			.login-box a:hover
			{
				color: #39dc79;
			}
			
			.error-box
			{
				font-size: 18px;	
				color: #FF0000;
				text-align: center;
			}

			select 
			{
				width:260px;
				height: 40px;
				
				background: #000000;
			}

	</style>
	<title>DR3MS::Disaster Risk Reduction and Resource Management System </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  	
	</head>
	<body>
	<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
	<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
	
	<?php $this->load->view('guest_header_view');?>

	<div class="login-box">
			<img src="<?php echo base_url("assets/img/avatar.png");?>" class="avatar">
			<div style="border:4px solid black;padding-left:5px;padding-right:5px;">
				<form class="form-horizontal" id="citizen_registration_form" action="<?php echo base_url("District/loadCitizenRegistration");?>"  method="POST" >
					<legend><center><h4><b><font style="color:white;">New Registration !!</font></b></h4></center></legend>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" style="margin-left:37px;width:200px;font-size:15;">Register Yourself</button>			
						</div>
				</form>
			</div>
			<br>
			<div style="border:4px solid black;padding-left:5px;padding-right:5px;">
			<form class="form-horizontal" id="citizen_registration_form">
				<legend><center><h4><b><font style="color:white;">Already Registered Citizens </font></b></h4></center></legend>
				<div class="form-group">
					<button type="button" class="btn btn-primary" style="margin-left:30px;width:220px;font-size:15;">Update Your Contact Number</button>			
				</div>
			</form>
			</div>
			<br>
			<br>
			<form role="form" name="regloginform" id="regloginform" action="<?php echo base_url("Guest/onClickBackToLogin");?>"  method="POST" >
			<div class = "form-group" id="btn-registered-user">
			<button type="submit"  class="btn btn-danger" style="margin-left:30px;width:200px;font-size:15;">Back to Login</button>
			</div>
			</form>
	</div>
	<div class="row" style="margin-right:0px;">
		<div class="col-sm-12"  style="	text-align: center;background: #ddd; position:fixed; bottom:0; right:0;">
			<h4>© This Website is developed and maintained by NIC, Lakhimpur District Unit.</h4>
		</div>
	</div>
</html>-->
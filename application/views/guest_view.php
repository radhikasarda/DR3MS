<html>
	<head>
	 <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
	<style>
				body{
				margin: 0;
				padding: 0;
				background: url(<?php echo base_url("assets/img/Login_bg.jpg");?>);
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
			<h1>Enter Details</h1>
			<br>
			<form role="form" name="guestLoginForm" id="guestLoginForm"  action="<?php echo base_url("login/validateGuestLogin");?>"  method="POST" >
						
			<div class = "form-group" id="input-mobile-no">
			<p>Mobile No.:<font color="#fff" size="2"><i> [Only 10 digits accepted]</i></font></p>			
			<input type="number" class="form-control" name="contact_no" placeholder="Enter Mobile No." id="contact_no" onkeypress="return isNumberKey(event)"  min="1111111111" max="9999999999" value="">			
			</div>
		
			<div class = "form-group" name="view-otp" id="view-otp" style="display:none;" >	
			<input type="text" class="form-control" name="otp-generated" id="otp-generated" readonly>	
			</div>
			
			<div class = "form-group" id="enter-otp" style="display:none;">
			<p>Enter OTP:</p>	
			<input type="text" class="form-control" name="otp" id="otp">		
			</div>
			
			<div class = "form-group" id="btn-get-otp">
			<button type="button"  class="btn btn-primary"  onClick = "return validateMobileNo();" style="margin-left:50px;width:150px;font-size:15;">GET OTP</button>
			</div>
			
			<div class = "form-group" id="btn-submit-otp" style="display:none;">
			<button type="button"  class="btn btn-primary"  onClick = "return submitOtp();" style="margin-left:50px;width:150px;font-size:15;">SUBMIT OTP</button>
			</div>
			
			</form>
			<div class = "form-group" id="or" style="margin-left:110px;"><p>OR</p></div>
			
			<form role="form" name="regloginform" id="regloginform" action="<?php echo base_url("District/");?>"  method="POST" >
			<div class = "form-group" id="btn-registered-user">
			<button type="submit"  class="btn btn-primary" style="margin-left:30px;width:200px;font-size:15;">Login as a Registered User</button>
			</div>
			</form>
	</div>
	<div class="row" style="margin-right:0px;">
		<div class="col-sm-12"  style="	text-align: center;background: #ddd; position:fixed; bottom:0; right:0;">
			<h4>© This Website is developed and maintained by NIC, Lakhimpur District Unit.</h4>
		</div>
	</div>
	
	
	<script>
		function isNumberKey(key)
		{
			var charCode = (key.which) ? key.which : event.keyCode;
			if(charCode >31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
			
		function validateMobileNo()
		{
			var contact_no = document.getElementById('contact_no').value;
			if(contact_no == ""){
				iqwerty.toast.Toast('Please Enter Mobile Number !!');
				return false;
			}
			if(contact_no > 9999999999)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			if(contact_no < 1111111111)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			else{
				$.ajax({
											url:"<?php echo site_url('Login/generateOtp');?>",
											method:"POST",
											data:{contact_no:contact_no},
											type: "POST",
											cache: false,
											success: function(data){	
												$("#input-mobile-no").hide(); 
												$("#btn-get-otp").hide();
												$("#btn-registered-user").hide();
												$("#or").hide();
												$("#btn-submit-otp").show();
 												$("#enter-otp").show();
												$("#view-otp").show(); 
												document.getElementById('otp-generated').value = data;
												
											}

				});
			}
			
			
		}
		
		function submitOtp()
		{
			var submitted_otp = document.getElementById('otp').value;
			if(submitted_otp == "")
			{
				iqwerty.toast.Toast('Please Enter OTP !!');
				return;
			}
			document.getElementById('guestLoginForm').submit();
			return true;
		}
		
		<?php if($this->session->flashdata('otpError')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('otpError'); ?>");
		<?php } ?>
	</script>
	</body>
	



</html>
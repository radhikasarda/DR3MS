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
				height: 520px;
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
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/js/aes.js');?> "></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/cryptojs/3.1.2/rollups/aes.js"></script> -->
	
	<div class ="index-view" id="index-view" >
		<?php $this->load->view('guest_header_view');?>
			<div class="login-box" id="login-box">				
				<img src="<?php echo base_url("assets/img/avatar.png");?>" class="avatar">
				<h1>Login Here</h1>
				<br>
				<h4>Selected District : <?php echo strtoupper($selected_district);?></h4>
				<br>
				<form role="form" name="loginform" id="loginform" action="<?php echo base_url("login/onLogin");?>"  method="POST" >
					<div class = "form-group">
						<p>Username</p>		
						<div class = "select-tag">
							<select name = "users" id="users">
								<option selected="selected">Choose one</option>
								<?php

									foreach($users as $user){
								?>
								<option value="<?php echo strtolower($user); ?>"><?php echo $user; ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class = "form-group">
						<p>Password</p>		
						<input type="password" name="password" placeholder="Enter Password" id="password" required>		
					</div>
					<div class = "form-group">
						<button type="button"  class="btn btn-primary"  onClick = "return prepareFormData()" style="margin-left:50px;width:150px;font-size:15;">Login</button>
					</div>
					<div class="error-box">
						<?php
							if (isset($msg)){ 
							echo $msg;
							}
						?>
					</div>			
				</form>
				<div style="margin-left:110px;"><p>OR</p></div></br>
				<form role="form" name="guestloginform" id="guestloginform" action="<?php echo base_url("District/loadGuestView");?>"  method="POST" >
					<div class = "form-group">
						<button type="submit"  class="btn btn-primary" style="margin-left:30px;width:200px;font-size:15;">Report As a Guest User</button>
					</div>
				</form>
				<div class ="row" id ="guest-view"></div>
		
			<script>

			function prepareFormData(){
					/* //alert("prepareFormData..");
		
					var user = document.getElementById('users').value;
					//alert("User.." + user);
					
					var pass = document.getElementById('password').value;	
					//alert("Pass.." + pass);
					
					//alert("PKey.." + "<?php echo $key;?>");
					
					var hkey = "<?php echo($key);?>";
					//alert("hkey.." + hkey);
					
					var key = CryptoJS.enc.Hex.parse(hkey);
					//alert("Key.." + key);
					
					var ivu = CryptoJS.lib.WordArray.random(128/8);
					//alert("IV.." + ivu);
					
					var ivp = CryptoJS.lib.WordArray.random(128/8);
					//alert("IV.." + ivp);
						
						
					var encUser = CryptoJS.AES.encrypt(user, key, {
					iv: ivu
					}).ciphertext;
					
					var encPass = CryptoJS.AES.encrypt(pass, key, {
						iv: ivp
					}).ciphertext;
					
					//alert("encUser.." + encUser);
					//alert("encPass.." + encPass);
						
					var outUser = ivu.concat(encUser).toString(CryptoJS.enc.Base64);
					var outPass = ivp.concat(encPass).toString(CryptoJS.enc.Base64);
					//	alert("Crypt Data Pass.." + outPass);
						
					/*var x=document.getElementById("users")
					alert("X.." + x);
					var option = document.createElement("option");
					alert("option.." + option);
					option.text = outUser;
					x.add(option);
					alert("X AFTER ADDING.." + x);
					alert("INDEX.." + option.index);
					document.getElementById('users').selectedIndex = option.index;
					
					var slectedVal= document.getElementById('users').value;
					
					alert("slectedVal.." + slectedVal);*/
					//document.getElementById('password').value = outPass;
					//alert("Submitting..");
					//	*/
					document.getElementById('loginform').submit();
					return true;
			}
			
			
			</script>
			
	
	</div>
	
	<div class="row" style="margin-right:0px;">
		<div class="col-sm-12"  style="	text-align: center;background: #ddd; position:fixed; bottom:0; right:0;">
			<h4>© This Website is developed and maintained by NIC, Lakhimpur District Unit.</h4>
		</div>
	</div>
	</div>
	</body>
	
</html>
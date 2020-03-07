<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		
	<title>DR3MS::HOME</title>
	
	<style>
		body {
			  font-family: "Lato", sans-serif;
			  background: url(<?php echo base_url("assets/img/bg.jpg");?>);			 
			}
		
					
			.card {
				position: relative;
				display: flex;
				flex-direction: column;
				min-width: 0;
				word-wrap: break-word;
				background-color: #fff;
				background-clip: border-box;
				border: 0 solid rgba(0,0,0,.125);
				border-radius: 0;
			}
			
			.card {
				margin-bottom: 30px;
			}
		
			.card-body {
				flex: 1 1 auto;
				min-height: 1px;
				padding: 1.25rem;
			}
			.d-flex {
				display: flex!important;
			}
			
			.align-self-center {
				align-self: center!important;
			}
			
			img {
				vertical-align: middle;
				border-style: none;
			}
			
			.mr-3, .mx-3 {
				margin-right: 1rem!important;
			}	

			.process-step .btn:focus{outline:none}
			.process{display:table;width:100%;position:relative; background:#f2f2f2;padding:15px;border-radius:10px;}
			.process-row{display:table-row}
			.process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
			.process-row:before{top:40px;bottom:0;position:absolute;content:" ";width:100%;height:1px;background-color:#ccc;z-order:0}	
			.process-step{display:table-cell;text-align:center;position:relative}
			.process-step p{margin-top:4px}
			.btn-circle{width:70px;height:70px;text-align:center;font-size:25px;border-radius:50%}
				
			input[type="password"] {
				margin-bottom: 20px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
			.form-control {
			  position: relative;
			  font-size: 16px;
			  height: auto;
			  padding: 10px;
				@include box-sizing(border-box);

				&:focus {
				  z-index: 2;
				}
			}
			
	</style>
	</head>	
	<body style="overflow-x:auto;overflow-y:auto;width:100%;">
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('assets/js/aes.js');?> "></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/Chart.js'?>"></script>				
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		<div class="row">
				<?php $this->load->view('dr3ms_header_view');?>		
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class ="row" >				
					<div class="process">
						<div class="process-row nav nav-tabs">
							<div class="process-step">
								<button type="button" class="btn btn-info btn-circle"  onClick="return onClickDashboard();"><i class="glyphicon glyphicon-dashboard"></i></button>
								<p><b>DASHBOARD</b></p>
							</div>
							<div class="process-step">
								<button type="button" class="btn btn-default btn-circle" onClick="return onClickLogin();"><i class="glyphicon glyphicon-log-in"></i></button>
								<p><b>LOGIN</b></p>
							</div>
							<div class="process-step">
								<button type="button" class="btn btn-default btn-circle" onClick="return onClickRegister();"><i class="glyphicon glyphicon-user"></i></button>
								<p><b>REGISTER</b></p>
							</div>
							<div class="process-step">
								<button type="button" class="btn btn-default btn-circle" onClick="return onClickReport();"><i class="glyphicon glyphicon-pencil"></i></button>
								<p><b>REPORT AN INCIDENT</b></p>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>			
		<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
				<div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h4><font color="black"><b>Selected District :&nbsp;<?php echo strtoupper($selected_district);?></b></font></h4>
                    </div>                    
                </div>
                <!-- Start row -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card" style="background-color: #FF0000!important;">
                            <div class="card-body">
                                <div class="d-flex no-block">
									<div class="mr-3 align-self-center"><img src="<?php echo base_url("assets/img/incident.png");?>" alt="Incident" style="height: 90px;" ></div>
                                    <div class="align-self-center">
                                        <h3><b><font color="white">Incidents Reported</font></b></h3>
                                        <h2><?php echo $total_incidents; ?></h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="background-color: #7460ee!important;">
                            <div class="card-body">
                                <div class="d-flex no-block">  
									<div class="mr-3 align-self-center"><img src="<?php echo base_url("assets/img/incident.png");?>" alt="Incident" style="height: 90px;" ></div>
                                    <div class="align-self-center">
                                          <h3><b><font color="white">Total Assets</font></b></h3>
										  <?php foreach((array)$total_assets as $total_assets){
												if($total_assets->no_of_assets == 0)
												{
													$assets = 0;
												}else
												{
													$assets = $total_assets->no_of_assets;
												}
										}
											  ?>
										  <h2><?=$assets;?></h2>
									</div>											
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="background-color: #FFB700!important;">
                            <div class="card-body">
                                <div class="d-flex no-block">    
									<div class="mr-3 align-self-center"><img src="<?php echo base_url("assets/img/incident.png");?>" alt="Incident" style="height: 90px;" ></div>
                                    <div class="align-self-center">
                                          <h3><b><font color="black">Total Health Centres</font></b></h3>
                                          <?php foreach((array)$total_health_centres as $total_health_centres){											  											  
											  if($total_health_centres->no_of_health_centre == 0)
												{
													$health_centres = 0;
												}else
												{
													$health_centres = $total_health_centres->no_of_health_centre;
												}
										  }
											  ?>
										  <h2><?=$health_centres;?></h2>
									</div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="background-color: #06d79c!important;">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="mr-3 align-self-center"><img src="<?php echo base_url("assets/img/incident.png");?>" alt="Incident" style="height: 90px;" ></div>
                                    <div class="align-self-center">
											<h3><b><font color="black">Total Institutions</font></b></h3>
                                          <?php foreach((array)$total_institutions as $total_institutions){
											   if($total_institutions->no_of_institution == 0)
												{
													$institutions = 0;
												}else
												{
													$institutions = $total_institutions->no_of_institution;
												}
										  }
											  
											  ?>
										  <h2><?=$institutions;?></h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End row -->  
				<!-- Start row -->
                <div class="row">
					<div class="col-lg-3">
				
					</div>
					<div class="col-lg-6 col-md-12" id="bar-chart-div" style="margin-bottom:110px;">
                        <div class="card" style="opacity:0.8;">
                            <div class="card-body">
                                <h4 style="text-align:center;"><b><u>Resources Present In Each Circle</u></b></h4>
                            </div>                 
                            <div class="chart-container">
                                <div id="bar-chart-overview">
									<canvas id="bar-chart">
									</canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
				
					</div>										
				</div>
				<div class="row">
					<div class="col-lg-4">
				
					</div>
					<div class="col-lg-4 col-md-12" id="login-div" style="margin-bottom:130px;display:none;">
                        <div class="card">
                            <div class="card-body">
                               <div id="login-form">	
									<form role="form" name="loginform" id="loginform" class="form-signin"  action="<?php echo base_url("login/onLogin");?>"  method="POST" style="padding:10px 15px 10px 15px;">       
										  <h2 class="form-signin-heading">Login Here</h2>
												<select name = "users" id="users" class="form-control">
													<option selected="selected" value="select">Choose one</option>
														<?php
															foreach($users as $user){
														?>
													<option value="<?php echo $user; ?>"><?php echo $user; ?>
													</option>
													<?php
														}
													?>
												</select>	
											<br>
											<br>
											<input type="password"  class="form-control" name="password" id="password" placeholder="Enter Password" required> 
											<br>		
											<button type="button" class="btn btn-lg btn-primary btn-block" onClick = "return prepareFormData();">Login</button>   
										</form>
								</div>
                            </div>                                            
						</div>
					</div>
					<div class="col-lg-4">
				
					</div>										
				</div>
				
				<div class="row">
					<div class="col-lg-4">
				
					</div>
					<div class="col-lg-4 col-md-12" id="register-div" style="margin-bottom:130px;display:none;">
                        <div class="card">
                            <div class="card-body">
                               <div id="register-form">	
																
								<form role="form" name="registerForm" id="registerForm"  action="<?php echo base_url("login/loadCitizenRegistration");?>"  method="POST" style="padding:10px 15px 10px 15px;">											
									<h1>Register Here !!</h1>
									<div class = "form-group" id="input-mobile-no">
									<p>Enter Mobile No.:<i> [Only 10 digits accepted]</i></font></p>			
									<input type="number" class="form-control" name="contact_no" placeholder="Enter Mobile No." id="contact_no" onkeypress="return isNumberKey(event)"  min="1111111111" max="9999999999" value="">			
									</div>
								
									<div class = "form-group" name="view-otp" id="view-otp" style="display:none;" >	
									<input type="text" class="form-control" name="otp-generated" id="otp-generated" readonly>	
									</div>
									
									<div class = "form-group" id="enter-otp" style="display:none;">
									<p>Enter OTP:</p>	
									<input type="text" class="form-control" name="otp" id="otp">		
									</div>
									<br>
									<div class = "form-group" id="btn-get-otp">
									<button type="button"  class="btn btn-primary btn-block"  onClick = "return validateMobileNoRegisterForm();">GET OTP</button>
									</div>
									<div class = "form-group" id="btn-submit-otp" style="display:none;">
									<button type="button"  class="btn btn-primary btn-block"  onClick = "return submitOtpRegisterForm()();" >SUBMIT OTP</button>
									</div>	

									<div class = "form-group" id="change-mobile-number">
									<p><i>Already Regsitered User Can Change Mobile Number Here&nbsp;</i><i class="glyphicon glyphicon-arrow-right"></i>&nbsp;<a href="javascript:onClickUpdateContactNumberLink();">Update Mobile No.</a></p>
									</div>
								</form>
								</div>
                            </div>                                            
						</div>
					</div>
					<div class="col-lg-4">
				
					</div>										
				</div>
				<div class="row">
					<div class="col-lg-4">
				
					</div>
					<div class="col-lg-4 col-md-12" id="guest-login-div" style="margin-bottom:130px;display:none;">
                        <div class="card">
                            <div class="card-body">
                               <div id="guest-form">	
									
								<form role="form" name="guestLoginForm" id="guestLoginForm"  action="<?php echo base_url("login/loadGuestReportView");?>"  method="POST" style="padding:10px 15px 10px 15px;">
									<h1>Enter Details !!</h1>
								<div class = "form-group" id="input-mobile-no-guest">
								<p>Enter Mobile No.:<i> [Only 10 digits accepted]</i></p>			
								<input type="number" class="form-control" name="contact_no_guest" placeholder="Enter Mobile No." id="contact_no_guest" onkeypress="return isNumberKey(event)"  min="1111111111" max="9999999999" value="">			
								</div>
							
								<div class = "form-group" name="view-otp-guest" id="view-otp-guest" style="display:none;" >	
								<input type="text" class="form-control" name="otp-generated-guest" id="otp-generated-guest" readonly>	
								</div>
								
								<div class = "form-group" id="enter-otp-guest" style="display:none;">
								<p>Enter OTP:</p>	
								<input type="text" class="form-control" name="otp-guest" id="otp-guest">		
								</div>
								<br>
								<div class = "form-group" id="btn-get-otp-guest">
								<button type="button"  class="btn btn-primary btn-block"  onClick = "return validateMobileNoGuestLoginForm();">GET OTP</button>
								</div>
								<div class = "form-group" id="btn-submit-otp-guest" style="display:none;">
								<button type="button"  class="btn btn-primary btn-block"  onClick = "return submitOtpGuestLoginForm();">SUBMIT OTP</button>
								</div>								
								</form>													
								</div>
                            </div>                                            
						</div>
					</div>
					<div class="col-lg-4">
				
					</div>										
				</div>
				
				<div class="row">
					<div class="col-lg-4">
				
					</div>
					<div class="col-lg-4 col-md-12" id="update-contact-div" style="margin-bottom:130px;display:none;">
                        <div class="card">
                            <div class="card-body">
                               <div id="guest-form">	
									
								<form role="form" name="updateContactForm" id="updateContactForm"  action="<?php echo base_url("login/updateContact");?>"  method="POST" style="padding:10px 15px 10px 15px;">
								<h1>Enter Details !!</h1>
								<div class = "form-group" id="input-mobile-no-previous">
								<p>Enter Previous Mobile No.:</p>			
								<input type="number" class="form-control" name="contact_no_previous" placeholder="Enter Previous Mobile No." id="contact_no_previous" onkeypress="return isNumberKey(event)"  min="1111111111" max="9999999999" value="">			
								</div>
								
								<div class = "form-group" id="citizen-name">
								<p>Enter Your Name:</p>	
								<input type="text" class="form-control" name="citizen_name" id="citizen_name">		
								</div>
								
								<div class = "form-group" id="citizen-father-name">
								<p>Enter Your Father's Name:</p>	
								<input type="text" class="form-control" name="citizen_father_name" id="citizen_father_name">		
								</div>
								<div class = "form-group" id="enter-new-contact" style="display:none;">
								<p>Enter New Number:</p>	
								<input type="number" class="form-control" name="contact_no_new" id="contact_no_new" onkeypress="return isNumberKey(event)"  min="1111111111" max="9999999999" value="">		
								</div>
								<br>
								<div class = "form-group" id="btn-next">
								<button type="button"  class="btn btn-primary btn-block"  onClick = "return validateCitizenPreviousDetails();">NEXT</button>
								</div>
								<div class = "form-group" id="btn-submit-new-contact" style="display:none;">
								<button type="button"  class="btn btn-primary btn-block"  onClick = "return validateNewMobileNo();">UPDATE</button>
								</div>								
								</form>													
								</div>
                            </div>                                            
						</div>
					</div>
					<div class="col-lg-4">
				
					</div>										
				</div>
			</div>
		</div>
	<div class="row" style="margin-right:0px;">
		<div class="col-sm-12"  style="	text-align: center;background: #ddd; position:fixed; bottom:0; right:0;opacity:0.7;">
			<h4>© This Website is developed and maintained by NIC, Lakhimpur District Unit.</h4>
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

<script>
	
	function ResetRegisterForm()
	{
		document.getElementById('contact_no').value = "";		
		$("#input-mobile-no").show(); 
		$("#btn-get-otp").show();																							
		$("#btn-submit-otp").hide();
 		$("#enter-otp").hide();
		$("#view-otp").hide(); 
	}
	
	function ResetLoginForm()
	{
		document.getElementById('password').value = '';
		document.getElementById("users").value = "select";
	}
	function ResetReportForm()
	{
		document.getElementById('contact_no_guest').value = "";
		$("#input-mobile-no-guest").show(); 
		$("#btn-get-otp-guest").show();			
		$("#btn-submit-otp-guest").hide();
 		$("#enter-otp-guest").hide();
		$("#view-otp-guest").hide();		
	}
	
	function ResetUpdateContactForm()
	{
		document.getElementById('contact_no_previous').value = "";		
		document.getElementById('citizen_name').value = "";		
		document.getElementById('citizen_father_name').value = "";	
		$("#citizen-name").show();	
		$("#citizen-father-name").show();
		$("#btn-submit-new-contact").hide();
		$("#enter-new-contact").hide();
		$("#input-mobile-no-previous").show();
		$("#btn-next").show();
	}
	function onClickDashboard()
	{
		
		$("#login-div").hide();
		$("#register-div").hide(); 
		$("#guest-login-div").hide(); 
		$("#update-contact-div").hide(); 
		$("#bar-chart-div").show();		
		
	}
	function onClickLogin()
	{
		ResetLoginForm();
		$("#register-div").hide();
		$("#bar-chart-div").hide();
		$("#guest-login-div").hide(); 
		$("#update-contact-div").hide(); 
		$("#login-div").show(); 			
	}
	
	function onClickRegister()
	{
		ResetRegisterForm();
		$("#bar-chart-div").hide();
		$("#login-div").hide(); 
		$("#guest-login-div").hide(); 
		$("#update-contact-div").hide(); 
		$("#register-div").show(); 						
												
	}
	
	function onClickReport()
	{
		ResetReportForm();
		$("#bar-chart-div").hide();
		$("#login-div").hide(); 
		$("#register-div").hide(); 
		$("#update-contact-div").hide(); 
		$("#guest-login-div").show(); 			
	}
	
	function onClickUpdateContactNumberLink()
	{
		ResetUpdateContactForm();
		$("#bar-chart-div").hide();
		$("#login-div").hide(); 
		$("#guest-login-div").hide(); 
		$("#register-div").hide(); 	
		$("#update-contact-div").show(); 
	}
			
			
	$(function(){
		 $('.btn-circle').on('click',function(){
		   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
		   $(this).addClass('btn-info').removeClass('btn-default').blur();
		 });

		 $('.next-step, .prev-step').on('click', function (e){
		   var $activeTab = $('.tab-pane.active');

		   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

		   if ( $(e.target).hasClass('next-step') )
		   {
			  var nextTab = $activeTab.next('.tab-pane').attr('id');
			  $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
			  $('[href="#'+ nextTab +'"]').tab('show');
		   }
		   else
		   {
			  var prevTab = $activeTab.prev('.tab-pane').attr('id');
			  $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
			  $('[href="#'+ prevTab +'"]').tab('show');
		   }
		 });
	});
	
	
	function isNumberKey(key)
		{
			var charCode = (key.which) ? key.which : event.keyCode;
			if(charCode >31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
			
		function validateMobileNoRegisterForm()
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
												$("#btn-submit-otp").show();
 												$("#enter-otp").show();
												$("#view-otp").show(); 
												document.getElementById('otp-generated').value = data;
												
											}

				});
			}
			
			
		}
		
		function submitOtpRegisterForm()
		{
			var submitted_otp = document.getElementById('otp').value;
			var generated_otp = document.getElementById('otp-generated').value;
			
			if(submitted_otp == "")
			{
				iqwerty.toast.Toast('Please Enter OTP !!');
				return false;
			}
			
			var s = submitted_otp.toString();
			var g = generated_otp.toString();
			
			var generated_otp_trim  = g.trim();
			var submitted_otp_trim  = s.trim();
			
			if(generated_otp_trim == submitted_otp_trim)
			{
				document.getElementById('registerForm').submit();			
				return true;
			}
			else
			{
				iqwerty.toast.Toast("The OTP entered is Incorrect !!");
				return false;
			}
		
		}
		function validateMobileNoGuestLoginForm()
		{
			var contact_no_guest = document.getElementById('contact_no_guest').value;
			if(contact_no_guest == ""){
				iqwerty.toast.Toast('Please Enter Mobile Number !!');
				return false;
			}
			if(contact_no_guest > 9999999999)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			if(contact_no_guest < 1111111111)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			else{
				$.ajax({
											url:"<?php echo site_url('Login/generateOtp');?>",
											method:"POST",
											data:{contact_no:contact_no_guest},
											type: "POST",
											cache: false,
											success: function(data){	
												$("#input-mobile-no-guest").hide(); 
												$("#btn-get-otp-guest").hide();																							
												$("#btn-submit-otp-guest").show();
 												$("#enter-otp-guest").show();
												$("#view-otp-guest").show(); 
												document.getElementById('otp-generated-guest').value = data;
												
											}

				});
			}
			
			
		}
		
		function submitOtpGuestLoginForm()
		{
			var submitted_otp = document.getElementById('otp-guest').value;
			var generated_otp = document.getElementById('otp-generated-guest').value;
			
			if(submitted_otp == "")
			{
				iqwerty.toast.Toast('Please Enter OTP !!');
				return false;
			}
			
			var s = submitted_otp.toString();
			var g = generated_otp.toString();
			
			var generated_otp_trim  = g.trim();
			var submitted_otp_trim  = s.trim();
			
			if(generated_otp_trim == submitted_otp_trim)
			{
				document.getElementById('guestLoginForm').submit();			
				return true;
			}
			else
			{
				iqwerty.toast.Toast("The OTP entered is Incorrect !!");
				return false;
			}
		
		}
		
		function validateCitizenPreviousDetails()
		{
			var contact_no_previous = document.getElementById('contact_no_previous').value;
			var citizen_name = document.getElementById('citizen_name').value;
			var citizen_father_name = document.getElementById('citizen_father_name').value;
			if(contact_no_previous == ""){
				iqwerty.toast.Toast('Please Enter Mobile Number !!');
				return false;
			}
			if(contact_no_previous > 9999999999)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			if(contact_no_previous < 1111111111)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			else{
				$.ajax({
											url:"<?php echo site_url('Login/validateCitizenPreviousDetails');?>",
											method:"POST",
											data:{contact_no:contact_no_previous,name:citizen_name,father_name:citizen_father_name},
											type: "POST",
											cache: false,
											success: function(data){	
												if(data != 0)
												{
													$("#input-mobile-no-previous").hide(); 
													$("#btn-next").hide();
													$("#citizen-name").hide();	
													$("#citizen-father-name").hide();													
													$("#btn-submit-new-contact").show();
													$("#enter-new-contact").show();													
												}
												else{
													iqwerty.toast.Toast('The Entered Details Are Not Correct !!');
													return;
												}
												
											}

				});
			}
			
		}
		
		function validateNewMobileNo()
		{
			var contact_no_new = document.getElementById('contact_no_new').value;
			if(contact_no_new == ""){
				iqwerty.toast.Toast('Please Enter Mobile Number !!');
				return false;
			}
			if(contact_no_new > 9999999999)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			if(contact_no_new < 1111111111)
			{
				iqwerty.toast.Toast('Please Enter Valid Mobile Number !!');
				return false;
			}
			
			else {
				$.ajax({
											url:"<?php echo site_url('Login/updateContactNo');?>",
											method:"POST",
											data:{contact_no:contact_no_new},
											type: "POST",
											cache: false,
											success: function(data){	
												if(data != 0)
													{																																				
														iqwerty.toast.Toast('Contact Number Updated Successfully!!');
														<?php echo $this->session->unset_userdata('contact'); ?>
														onClickRegister();
														
													}
													else
													{
														iqwerty.toast.Toast('Internal server error ...Please TRY again!!');
														return;
													}
												
											}

				});
			}
		}
		<?php if($this->session->flashdata('otpError')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('otpError'); ?>");
		<?php } ?>
</script>
<script>
			$('select').on('change', function() {
					document.getElementById('password').value = '';
			});
			<?php if($this->session->flashdata('validationFail')){  ?>
			iqwerty.toast.Toast("<?php echo $this->session->flashdata('validationFail'); ?>");
			<?php } ?>
			$(document).ready(function() {
				//To disable enter key on submit
			  $(window).keydown(function(event){
				if(event.keyCode == 13) {
				  event.preventDefault();
				  return false;
				}
			  });
			});
			function prepareFormData(){
					
					//alert("inside preparedata");
					var user = document.getElementById('users').value;
					
					if(user == "select")
					{
						iqwerty.toast.Toast('Please select a Username!!');
						return;
					}
					//alert("User.." + user);
					
					var pass = document.getElementById('password').value;	
					if(pass == "")
					{
						iqwerty.toast.Toast('Please enter a Password!!');
						return;
					}
					
					//alert("Pass.." + pass);
					
					//alert("PKey.." + "<?php echo $key;?>");
					
					var hkey = "<?php echo($key);?>";
					//alert("hkey.." + hkey);
					
					var key = CryptoJS.enc.Hex.parse(hkey);					
					//alert("Key.." + key);
					//
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
	
					optionText = outUser; 
					optionValue = outUser; 

					var option = new Option(optionText, optionValue);
					
					$("#users").append(option);
					$("#users").val(optionValue);

					document.getElementById('password').value = outPass;

					document.getElementById('loginform').submit();
					return true;
			}
			
			
			</script>
			
</html>
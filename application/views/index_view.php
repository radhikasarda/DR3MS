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
	
	<body onload="selectDistrict()">
	
	<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
	<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/js/aes.js');?> "></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/cryptojs/3.1.2/rollups/aes.js"></script> -->
	
	<form role="form" name="district-form" id="district-form" action="<?php echo base_url("District/getSelelctedDistrict");?>"  method="POST" >
		<div id="myModal" role="dialog" class="modal fade" data-backdrop="static" data-keyboard="false">
			
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
					<div class="row" style="margin-left:0px;margin-top:0px;"><?php $this->load->view('guest_header_view');?></div>
					
				</div>
				<div class="modal-body" >					
					<div class="row" style="text-align:center;">
					<div class="container" style="display: inline-block;">
						<div class="col-sm-1" >							
						</div>
						<div class="col-sm-2" >
							 <h4>Select District :</h4>
						</div>
						<div class="col-sm-2">
							<div class = "select-district">						
								<select name = "districts" id="districts" style="background:#FFF;">
									<option selected="selected" value = "select">Choose one</option>
									<?php

										foreach($districts as $district){
									?>
									<option value="<?php echo strtolower($district); ?>"><?php echo $district; ?>
									</option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-1" >							
						</div>
						<div class="col-sm-1">
						<button type="button" class="btn btn-success" onClick="return getSelelctedDistrict()">SUBMIT</button>
						</div>
					</div>
					</div>
				</div>
				<div class="modal-footer">
				</div>
			</div>
			</div>	
		</div>		
	</form>	
			<script>
			function selectDistrict()
			{
				$('#index-view').hide();				
				$('#myModal').modal('show');
			}
			function getSelelctedDistrict()
			{
					var selected_district = document.getElementById('districts').value;
					if(selected_district == 'select')
					{
						iqwerty.toast.Toast('Please Select a District !!');
						return;
					}
					
					
					else
					{						
						document.getElementById('district-form').submit();	
						return true;
					}
			}						
			</script>
			
	
	
	<div class="row" style="margin-right:0px;">
		<div class="col-sm-12"  style="	text-align: center;background: #ddd; position:fixed; bottom:0; right:0;">
			<h4>© This Website is developed and maintained by NIC, Lakhimpur District Unit.</h4>
		</div>
	</div>
	</body>
	
</html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
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
		<title>DR3MS::Audit Trail</title>
		
	</head>
	
	<body style="overflow-x:auto;overflow-y:auto;">
	
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>	
		<nav class="navbar navbar-inverse" id="selection-bar" style="background-color: #FFB700;margin-top:-20px;">
			<div class="row" style="margin-left:10px;">
				<div class="col-sm-2">
					<div class = "row">
						<label>Select User:</label>
					</div>
					<div class = "row">				
						<select class="form-control" name = "users" id="users"  >
								<option value="All">All</option>
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
				<div class="col-sm-2">
					<div class = "row">
						<label>From Date:</label>
					</div>
					<div class = "row">				
						<div class="input-group date" data-date-format="yyyy-mm-dd" >
							<input  type="text" class="form-control" placeholder="yyyy-mm-dd" id="fromDate">
								<div class="input-group-addon" >
									<span class="glyphicon glyphicon-th"></span>
								</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class = "row">
						<label>To Date:</label>
					</div>
					<div class = "row">				
						<div class="input-group date" data-date-format="yyyy-mm-dd">
							<input  type="text" class="form-control" placeholder="yyyy-mm-dd"  id="toDate">
								<div class="input-group-addon" >
									<span class="glyphicon glyphicon-th"></span>
								</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class = "row">						
					</div>
					<div class = "row">				
						<button type="button" class="btn btn-primary" onclick="return GetSelectedData();" style="margin-top:25px;margin-left:5px;">SUBMIT</button>	
					</div>
				</div>
			</div>
		</nav>
		<div id ="report-audit-trail">
			<div class="container" style="overflow-x:auto;overflow-y:auto;">
					<table id ="report-table" class="table table-striped table-bordered">					
					</table>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$('.input-group.date').datepicker({format: "yyyy-mm-dd"}); 
			});
			
			function GetSelectedData()
			{
				var user = document.getElementById('users').value;
				
				var fromDate =  document.getElementById("fromDate").value;
							
				var toDate =  document.getElementById("toDate").value;
				
				if(fromDate == '')
				{
					iqwerty.toast.Toast('Select a FROM DATE !!');
					return;
				}
				if(toDate == '')
				{
					iqwerty.toast.Toast('Select a TO DATE !!');
					return;
				}
				if ((Date.parse(toDate) <= Date.parse(fromDate))) 
				{
					iqwerty.toast.Toast('To Date should be greater than From Date !!');
					return;
				}
				
				var fromDateTime = fromDate + " " +"00:00:00";
				var toDateTime = toDate + " " +"23:59:59";

				$.ajax({
							url:"<?php echo site_url('Audit_Trail/onClickSubmitSelectedData');?>",
							method:"POST",
							data:{user:user,fromDateTime:fromDateTime,toDateTime:toDateTime},
							type: "POST",
							cache: false,
							success: function(data)
							{											
								$('#report-table').html(data); 
							}

				});
			}	
		</script>
	</body>
</html>
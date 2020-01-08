
<div class ="row" style="margin-right:0px;">
	<div class="col-sm-12" style ="background-color: #333;padding: 20px;color: white;font-size: 40px;" >
		<h1 style ="margin: 0;text-align: center;font-size: 22px;">DISASTER RISK REDUCTION, REPORTING AND RESOURCE MANAGEMENT SYSTEM</h1>
	</div>
</div>
<div class = "row" style="margin-right:0px;">
	<div class = "col-sm-6" style = "text-align: left; background-color: #FFB700;height: 25px;">
		<i class="glyphicon glyphicon-user"></i>
			<font color="#000000" size="4">
				"You are logged in as : <?php echo $this->session->userdata('userid'); ?>" 
				&ensp;
				<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
				Last Login Time : 	
				<?php foreach((array)$last_login as $last_login){	 
					 echo $last_login->last_login_time;
				}?>
			</font>					
	</div>
	<div class = "col-sm-6" style = "text-align: right;  height: 25px;background-color: #FFB700;">
		<form action="<?php echo base_url("login/logout");?>">				
			<input type="submit" class="logoutbutton" value="LOGOUT">
		</form>
	</div>
</div>

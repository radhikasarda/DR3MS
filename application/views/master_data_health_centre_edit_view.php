<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$name_of_health_centre = $row['name_of_health_centre'];
			$address = $row['address'];
			$ph_no_of_health_centre = $row['ph_no_of_health_centre'];
			$no_of_doctors = $row['no_of_doctors'];
			$nos_of_anm = $row['nos_of_anm'];
			$building_type = $row['building_type'];
			$nos_of_bed = $row['nos_of_bed'];
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-health-centre">
			<div class="container">
				<form class="well form-horizontal" id="health_centre_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Health Centre</b></h2></center></legend><br>
							<div class="form-group">
							  <label class="col-md-4 control-label">Select Circle</label>  
								<div class="col-md-4 inputGroupContainer">								
									<select class="form-control" name = "circle_names" id="circle_names"  >
											<option value="Select">Select Circle</option>
											<?php
											foreach($circles as $row)
											{ 
											?>
												<option <?php if ($selected_circle == $row->circle_name ) echo 'selected' ; ?> value="<?php echo $row->circle_name; ?>"><?php echo $row->circle_name; ?></option>
												
											<?php
											}
											?>							
									</select>										
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select Block</label> 
									<div class="col-md-4 inputGroupContainer">								
										<select class="form-control" name = "block_names" id="block_names" >							
										</select>									
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
										<select class="form-control" name = "gp_names" id="gp_names" >
										</select>
									</div>
							</div>							
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Health Centre</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_health_centre" class="form-control" type="text" id="name_of_health_centre" value="<?php echo $name_of_health_centre; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="address" class="form-control"  type="text" id="address" value="<?php echo $address; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No. </label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="contact_no"  class="form-control"  type="text" value="<?php echo $ph_no_of_health_centre; ?>">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Doctors</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_doctors" class="form-control"  type="number" min="0" value="<?php echo $no_of_doctors; ?>">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of ANM</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_anm" class="form-control"  type="number" min="0" value="<?php echo $nos_of_anm; ?>">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Building Type </label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="building_type"  class="form-control"  type="text" value="<?php echo $building_type; ?>">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Beds</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_beds" class="form-control"  type="number" min="0" value="<?php echo $nos_of_bed; ?>">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateHealthCentreData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
								</div>
							</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class = "col-sm-2">
	</div>
</div>
<script type="text/javascript">
							
			function set_block_names(){
									var circle_id=$('#circle_names').val();
									if(circle_id != '')
									{
											$.ajax({
											url : "<?php echo site_url('Master_Data_Update_Delete/get_blocks');?>",
											method : "POST",
											data : {circle_id: circle_id},
											success: function(data)
											{	
												$('#block_names').html(data);
												document.getElementById('block_names').value = "<?php echo $selected_block ; ?>"; 		
												set_gp_names();	
											}
											});
									}else
									{
										  $('#block_names').html('<option value="Select">Select Block</option>');
										  $('#gp_names').html('<option value="Select">Select GP</option>');
									}
							}
							function set_gp_names()
							{
								 var block_id = $('#block_names').val();
									  if(block_id != '')
									  {
									   $.ajax({
										url:"<?php echo site_url('Master_Data_Update_Delete/get_gp');?>",
										method:"POST",
										data:{block_id:block_id},
										success:function(data)
										{
										 $('#gp_names').html(data);
										 document.getElementById('gp_names').value = "<?php echo $selected_gp ; ?>"; 		
										}
									   });
									  }
									  else
									  {
									   $('#gp_names').html('<option value="Select">Select GP</option>');
									  }
								
							}
							$(document).ready(function(){
								
							set_block_names();
							
							});	
							
							$('#circle_names').change(function(){ 
									set_block_names();	
									set_gp_names();		
							}); 
								
							$('#block_names').change(function(){ 
									set_gp_names();	
										
							});
						</script>
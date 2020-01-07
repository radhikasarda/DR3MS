<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$village_name = $row['village_name'];
			$location = $row['location'];
			$gps_point = $row['gps_point'];
			$provider = $row['provider'];
			$name_of_provider = $row['name_of_provider'];						
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-handpump-ring-well">
			<div class="container">
				<form class="well form-horizontal" id="handpump_ring_well_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For HandPump & Ring Well</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Village</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="village" class="form-control" type="text" id="village"  value="<?php echo $village_name; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden"  >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Location</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="location" class="form-control"  type="text" id="location"  value="<?php echo $location; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">GPS Point</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="gps_point" name="gps_point" type="text"  value="<?php echo $gps_point; ?>"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Provider</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="provider" class="form-control"  type="text"  value="<?php echo $provider; ?>">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Provider</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="name_of_provider" class="form-control"  type="text" id="name_of_provider"  value="<?php echo $name_of_provider; ?>">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateHandPumpRingWellData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
								</div>
							</div>
							<div class="form-group">
							 <label class="col-md-5 control-label"></label>
							 <div class="col-md-2"><br>
									<button type="button" class="btn btn-danger form-control" onclick="return onClickBack();">BACK</button>
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
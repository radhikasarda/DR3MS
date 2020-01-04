<?php

		foreach($data_item_details as $row)
		{
			$gp_no = $row['gp_no'];
			$selected_block_name = $row['block_name'];
			$selected_circle_name = $row['circle_name'];
			$selected_gp_name = $row['gp_name'];
			log_message('info','########## selected_circle_name:: '.$selected_circle_name);
			log_message('info','########## selected_block_name:: '.$selected_block_name);
			log_message('info','########## selected_gp_name:: '.$selected_gp_name);
		}
			
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-gp">
			<div class="container">
				<form class="well form-horizontal" id="gp_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For GP</b></h2></center></legend><br>						
							<div class="form-group">
							  <label class="col-md-4 control-label">Select Circle</label>  
								<div class="col-md-4 inputGroupContainer">								
									<select class="form-control" name = "circle_names" id="circle_names"  >
											<?php
											foreach($circles as $row)
											{ 
											?>
												<option <?php if ($selected_circle_name == $row->circle_name ) echo 'selected' ; ?> value="<?php echo $row->circle_name; ?>"><?php echo $row->circle_name; ?></option>
												
											<?php
											}
										?>							
									</select>									
							  </div>
							</div>	
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Select Block</label> 
								<div class="col-md-4 inputGroupContainer">									
									<select class="form-control" name = "block_names" id="block_names" >							
									</select>									
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of GP</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_gp" class="form-control" type="text" id="name_of_gp" value="<?php echo $selected_gp_name; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='id' id='id' value="<?php echo $gp_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateGpData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
<script>
		function set_block_names()
		{
								
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
						document.getElementById('block_names').value = "<?php echo $selected_block_name ; ?>"; 						
					}
					});
				}else
				{
					$('#block_names').html('<option value="Select">Select Block</option>');
				}
		}
		$(document).ready(function()
		{
			set_block_names();		
			$('#circle_names').change(function()
			{ 			
			set_block_names();								
			}); 			
																	
		});
							
		
</script>
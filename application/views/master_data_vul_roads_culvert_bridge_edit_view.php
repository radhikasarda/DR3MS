<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$vulnerable_roads = $row['vulnerable_roads'];
			$vulnerable_culvert = $row['vulnerable_culvert'];
			$vulnerable_bridges = $row['vulnerable_bridges'];
			$status = $row['status'];
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-vul-roads-culvert-bridge">
			<div class="container">
				<form class="well form-horizontal" id="vul_roads_culvert_bridge_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Vulnerable Roads, Culvert & Bridges</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Select Block</label> 
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
							  <label class="col-md-4 control-label">Name of Vulnerable Road</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_vul_road" class="form-control" type="text" id="name_of_vul_road" value="<?php echo $vulnerable_roads; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Vulnerable Culvert</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_vul_culvert" class="form-control" type="text" id="name_of_vul_culvert" value="<?php echo $vulnerable_culvert; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Vulnerable Bridge</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_vul_bridge" class="form-control" type="text" id="name_of_vul_bridge" value="<?php echo $vulnerable_bridges; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Status</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="status" class="form-control" type="text" id="status" value="<?php echo $status; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateVulRoadCulvertBridgeData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
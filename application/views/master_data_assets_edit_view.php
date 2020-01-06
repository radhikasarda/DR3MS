<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$name_of_item = $row['name_of_item'];
			$no_of_item = $row['no_of_item'];
			$name_of_owner = $row['name_of_owner'];
			$address_of_owner = $row['address_of_owner'];
			$contact_no_of_owner = $row['contact_no_of_owner'];
			$capacity_to_hold_people = $row['capacity_to_hold_people'];
		}
?>

<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-assets">
			<div class="container">
				<form class="well form-horizontal" id="assets_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Assets</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Name of Item</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_item" class="form-control" type="text" id="name_of_item" value="<?php echo $name_of_item; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Items</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="no_of_item" class="form-control"  type="number" id="no_of_item" min="0" value="<?php echo $no_of_item; ?>">					
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Owner</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="name_of_owner"  class="form-control"  type="text" value="<?php echo $name_of_owner; ?>">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address of Owner</label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="address" class="form-control"  type="text" value="<?php echo $address_of_owner; ?>">							
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No.</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="contact_no" class="form-control"  type="text" id="contact_no" value="<?php echo $contact_no_of_owner; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Capacity to Hold People</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="capacity" name="capacity" type="number" min="0" value="<?php echo $capacity_to_hold_people; ?>"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateAssetsData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
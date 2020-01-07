<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$total_rev_village = $row['total_rev_village'];
			$total_govt_land = $row['total_govt_land'];
			$total_forest_land = $row['total_forest_land'];
			$designation = $row['designation'];
			$name_of_members = $row['name_of_members'];
			$contact_no_of_members = $row['contact_no_of_members'];
			$address_of_members = $row['address_of_members'];

		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-task-force">
			<div class="container">
				<form class="well form-horizontal" id="task_force_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Task Force Committee</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Total Rev. Village</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="total_rev_village" name="total_rev_village" type="number" min="0" value="<?php echo $total_rev_village; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >					
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total Govt. Land</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_govt_land" class="form-control"  type="text" id="total_govt_land" value="<?php echo $total_govt_land; ?>">						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total Forest Land</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_forest_land" class="form-control"  type="text" id="total_forest_land" value="<?php echo $total_forest_land; ?>">						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Designation</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="designation" class="form-control"  type="text" id="designation" value="<?php echo $designation; ?>">						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Members</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="name_of_members" name="name_of_members" type="text" value="<?php echo $name_of_members; ?>"/>
									<label class="control-label"><font color="red"><font size="2">Use a comma to enter names of more than 1 member.</font></font></label>
									<label class="control-label"><font color="red"><font size="2">Eg. ABC,XYZ</font></font></label>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No. of Members</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="contact_no" class="form-control"  type="text" id="contact_no" value="<?php echo $contact_no_of_members; ?>">
									<label class="control-label"><font color="red"><font size="2">Use a comma to enter more than 1 contact no.</font></font></label>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Adress of Members</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="address" class="form-control"  type="text" id="address" value="<?php echo $address_of_members; ?>">
									<label class="control-label"><font color="red"><font size="2">Use a comma to enter more than 1 address.</font></font></label>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateTaskForceData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
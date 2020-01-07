<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$name_of_school = $row['name_of_school'];
			$address_of_camp = $row['address_of_camp'];
			$ph_no_of_owner = $row['ph_no_of_owner'];
			$nos_of_class_room = $row['nos_of_class_room'];
			$type_of_building = $row['type_of_building'];
			$nos_of_toilets = $row['nos_of_toilets'];
			$sources_of_drinking_water = $row['sources_of_drinking_water'];
			$open_space = $row['open_space'];
			$availability_of_electricity = $row['availability_of_electricity'];	
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-relif-camp">
			<div class="container">
				<form class="well form-horizontal" id="relif_camp_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Relief Camp</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Name of School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_school" class="form-control" type="text" id="name_of_school" value="<?php echo $name_of_school; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address of Camp</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="address" class="form-control"  type="text" id="address" value="<?php echo $address_of_camp; ?>">						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No. of Owner</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="contact_no" class="form-control"  type="text" id="contact_no" value="<?php echo $ph_no_of_owner; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Classroom</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="no_of_classroom" name="no_of_classroom" type="number" min="0" value="<?php echo $nos_of_class_room; ?>"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Type of Building</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="type_of_building" class="form-control"  type="text" id="type_of_building" value="<?php echo $type_of_building; ?>">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Toilets</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="no_of_toilets" name="no_of_toilets" type="number" min="0" value="<?php echo $nos_of_toilets; ?>"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Source Of Drinking Water</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<select class="form-control" name = "source_of_drinking_water" id="source_of_drinking_water">
										<option value="select">Select Source</option>
										<option value="ring well">Ring Well</option>
										<option value="tube well">Tube Well</option>
										<option value="water supply">Water Supply</option>
										<option value="water bodies">Water Bodies</option>
										<option value="others">Others</option>
									</select>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Open Space</label>  
								<div class="col-md-4 inputGroupContainer" style="margin-top:5px;">
									<input type="radio" name="yes" value="yes" id="open_space_yes">Yes&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
									<input type="radio" name="no" value="no"id="open_space_no">No				
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Availabilty of Electricity</label>  
								<div class="col-md-4 inputGroupContainer" style="margin-top:5px;">
									<input type="radio" name="yes" value="yes" id="electricity_available_yes">Yes&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
									<input type="radio" name="no" value="no" id="electricity_available_no">No				
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateRelifCampData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$total_pop = $row['total_pop'];
			$male_child = $row['male_child'];
			$female_child = $row['female_child'];
			$male_adult = $row['male_adult'];
			$female_adult = $row['female_adult'];
			$male_old = $row['male_old'];
			$female_old = $row['female_old'];
			$nos_of_bpl_families = $row['nos_of_bpl_families'];
			$families_with_pucca_house = $row['families_with_pucca_house'];
			$families_with_Kutcha_house = $row['families_with_Kutcha_house'];
			$landless_family = $row['landless_family'];
			$homeless_family = $row['homeless_family'];
							
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-demographic">
			<div class="container">
				<form class="well form-horizontal" id="demographic_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Demographic & Socio Economic</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Total Population</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_population" class="form-control" type="number" min="0" id="total_population" value="<?php echo $total_pop; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Child</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_child" class="form-control"  type="number" id="male_child" min="0" value="<?php echo $male_child; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Child</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_child" class="form-control"  type="number" id="female_child" min="0" value="<?php echo $female_child; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Adult</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_adult" class="form-control"  type="number" id="male_adult" min="0" value="<?php echo $male_adult; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Adult</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_adult" class="form-control"  type="number" id="female_adult" min="0" value="<?php echo $female_adult; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Old</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_old" class="form-control"  type="number" id="male_old" min="0" value="<?php echo $male_old; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Old</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_old" class="form-control"  type="number" id="female_old" min="0" value="<?php echo $female_old; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of BPL Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="no_of_bpl_families" class="form-control"  type="number" id="no_of_bpl_families" min="0" value="<?php echo $nos_of_bpl_families; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Families with Pucca House</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="families_with_pucca_house" class="form-control"  type="number" id="families_with_pucca_house" min="0" value="<?php echo $families_with_pucca_house; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Families with Kutcha House</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="families_with_kutcha_house" class="form-control"  type="number" id="families_with_kutcha_house" min="0" value="<?php echo $families_with_Kutcha_house; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Landless Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="landless_families" class="form-control"  type="number" id="landless_families" min="0" value="<?php echo $landless_family; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Homeless Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="homeless_families" class="form-control"  type="number" id="homeless_families" min="0" value="<?php echo $homeless_family; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateDemographicData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
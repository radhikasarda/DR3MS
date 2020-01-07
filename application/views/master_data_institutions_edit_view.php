<?php

		foreach($data_report_detailed_info as $row)
		{
			$s_no = $row['s_no'];
			$total_lp_School = $row['total_lp_School'];
			$total_me_School = $row['total_me_School'];
			$total_high_school = $row['total_high_school'];
			$total_hs_School = $row['total_hs_School'];
			$total_nos_of_college = $row['total_nos_of_college'];
			$others = $row['others'];
					
		}
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-institution">
			<div class="container">
				<form class="well form-horizontal" id="institution_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Institution</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Total LP School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_lp_school" class="form-control" type="number" min="0" id="total_lp_school" value="<?php echo $total_lp_School; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='s_no' id='s_no' value="<?php echo $s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total ME School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_me_school" class="form-control"  type="number" id="total_me_school" min="0" value="<?php echo $total_me_School; ?>">							
							  </div> 
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total High School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_high_school" class="form-control"  type="number" id="total_high_school" min="0" value="<?php echo $total_high_school; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total HS School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_hs_school" class="form-control"  type="number" id="total_hs_school" min="0" value="<?php echo $total_hs_School; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total No. of College</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_college" class="form-control"  type="number" id="total_college" min="0" value="<?php echo $total_nos_of_college; ?>">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Other Institutions</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="other_institutions" class="form-control"  type="number" id="other_institutions" min="0" value="<?php echo $others; ?>">							
							  </div>
							</div>
													
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateInstitutionData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
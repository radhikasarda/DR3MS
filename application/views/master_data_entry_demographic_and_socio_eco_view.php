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
									<select class="form-control" name = "circles" id="circles"  >
										<?php $circle_name = $this->session->userdata('circle_name');
											if($circle_name == 'All'){
											?><option value="Select">Select Circle</option>
											<?php
											}
											?>
											<?php
											foreach($circles as $row)
											{
											 echo '<option value="'.$row->circle_name.'">'.$row->circle_name.'</option>';
											}
										?>							
									</select>									
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select Block</label> 
									<div class="col-md-4 inputGroupContainer">								
										<select class="form-control" name = "blocks" id="blocks" >							
										</select>									
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Select GP</label> 
									<div class="col-md-4 inputGroupContainer">
										<select class="form-control" name = "gp" id="gp" >
										</select>
									</div>
							</div>							
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Total Population</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="total_population" class="form-control" type="number" min="0" id="total_population">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Child</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_child" class="form-control"  type="number" id="male_child" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Child</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_child" class="form-control"  type="number" id="female_child" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Adult</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_adult" class="form-control"  type="number" id="male_adult" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Adult</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_adult" class="form-control"  type="number" id="female_adult" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Male Old</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="male_old" class="form-control"  type="number" id="male_old" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Female Old</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="female_old" class="form-control"  type="number" id="female_old" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of BPL Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="no_of_bpl_families" class="form-control"  type="number" id="no_of_bpl_families" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Families with Pucca House</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="families_with_pucca_house" class="form-control"  type="number" id="families_with_pucca_house" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Families with Kutcha House</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="families_with_kutcha_house" class="form-control"  type="number" id="families_with_kutcha_house" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Landless Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="landless_families" class="form-control"  type="number" id="landless_families" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Homeless Families</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="homeless_families" class="form-control"  type="number" id="homeless_families" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddDemographicData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
			var circle_id=$('#circles').val();
			if(circle_id != '')
			{
				$.ajax({
				url : "<?php echo site_url('Incident/get_blocks');?>",
				method : "POST",
				data : {circle_id: circle_id},
				success: function(data)
				{	
				    $('#blocks').html(data);
					$('#gp').html('<option value="Select">Select GP</option>');

				}
				});
			}else
			{
				$('#blocks').html('<option value="Select">Select Block</option>');
				$('#gp').html('<option value="Select">Select GP</option>');
			}
		}
		$(document).ready(function()
		{
			set_block_names();
			$('#circles').change(function(){ 
			set_block_names();												
			}); 
								
			$('#blocks').change(function()
			{
				var block_id = $('#blocks').val();
				if(block_id != '')
				{
					$.ajax({
					url:"<?php echo site_url('Incident/get_gp');?>",
					method:"POST",
					data:{block_id:block_id},
					success:function(data)
					{
						$('#gp').html(data);
					}
					});
				}
				else
				{
					$('#gp').html('<option value="Select">Select GP</option>');
				}
			});
																	
		});		
</script>
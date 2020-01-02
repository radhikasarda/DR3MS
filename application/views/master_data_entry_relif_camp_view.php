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
							  <label class="col-md-4 control-label">Select Block</label> 
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
							  <label class="col-md-4 control-label">Name of School</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_school" class="form-control" type="text" id="name_of_school">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address of Camp</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="address" class="form-control"  type="text" id="address">						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No. of Owner</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="contact_no" class="form-control"  type="text" id="contact_no">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Classroom</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="no_of_classroom" name="no_of_classroom" type="number" min="0"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Type of Building</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="type_of_building" class="form-control"  type="text" id="type_of_building">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Toilets</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="no_of_toilets" name="no_of_toilets" type="number" min="0"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Source Of Drinking Water</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<select class="form-control" name = "source_of_drinking_water" id="source_of_drinking_water">
										<option value="select">Select Source</option>
										<option value="ring_well">Ring Well</option>
										<option value="tube_well">Tube Well</option>
										<option value="water_supply">Water Supply</option>
										<option value="water_bodies">Water Bodies</option>
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
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddRelifCampData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
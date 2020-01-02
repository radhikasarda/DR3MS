<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-health-centre">
			<div class="container">
				<form class="well form-horizontal" id="health_centre_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Health Centre</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Name of Health Centre</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_health_centre" class="form-control" type="text" id="name_of_health_centre">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="address" class="form-control"  type="text" id="address">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No. </label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="contact_no"  class="form-control"  type="text">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Doctors</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_doctors" class="form-control"  type="number" min="0">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of ANM</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_anm" class="form-control"  type="number" min="0">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Building Type </label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="building_type"  class="form-control"  type="text">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">No. of Beds</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="no_of_beds" class="form-control"  type="number" min="0">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddHealthCentreData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-community-hall">
			<div class="container">
				<form class="well form-horizontal" id="community_hall_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Commmunity Hall</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Community Hall</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="community_hall" class="form-control" type="text" id="community_hall">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Capacity to Hold People 1</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="capacity_1" class="form-control"  type="number" id="capacity_1" min="0">							
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address</label>  
								<div class="col-md-4 inputGroupContainer">						 
									<input id="address"  class="form-control"  type="text">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No of Owner</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input id="contact_no" class="form-control"  type="text">						
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Capacity to Hold People 2</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="capacity_2" class="form-control"  type="number" id="capacity_2" min="0">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">GPS Point</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="gps_point" name="gps_point" type="text" />						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddCommunityHallData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
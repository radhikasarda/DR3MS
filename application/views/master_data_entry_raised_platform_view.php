<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-raised-platform">
			<div class="container">
				<form class="well form-horizontal" id="raised_platform_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Raised Platform</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Raised Platform</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="raised_platform" class="form-control" type="text" id="raised_platform">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Address</label>  
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
							  <label class="col-md-4 control-label">Capacity to Hold People</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="capacity" name="capacity" type="number" min="0"/>						
								</div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label">GPS Point</label>  
								<div class="col-md-4 inputGroupContainer">
									<input class="form-control" id="gps_point" name="gps_point" type="number" min="0"/>						
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddRaisedPlatformData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
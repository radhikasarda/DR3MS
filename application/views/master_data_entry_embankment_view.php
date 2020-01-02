<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-embankment">
			<div class="container">
				<form class="well form-horizontal" id="embankment_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Embankment</b></h2></center></legend><br>
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
							  <label class="col-md-4 control-label">Name of Embankment</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_embankment" class="form-control" type="text" id="name_of_embankment">
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Status</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<select class="form-control" name = "status" id="status">
										<option value="select">Select Status</option>
										<option value="weak">Weak</option>
										<option value="strong">Strong</option>
									</select>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Village Coverage</label>  
								<div class="col-md-4 inputGroupContainer">
									<input  name="village_coverage" class="form-control" type="number" id="village_coverage" min="0">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddEmbankmentData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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
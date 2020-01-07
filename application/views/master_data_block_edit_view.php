<?php

		foreach($data_item_details as $row)
		{
			$b_s_no = $row['b_s_no'];
			$selected_circle_name = $row['circle_name'];
			$block = $row['block'];
			log_message('info','########## selected_circle_name:: '.$selected_circle_name);
			log_message('info','########## block:: '.$block);
		}
			
?>
<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-block">
			<div class="container">
				<form class="well form-horizontal" id="block_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Block</b></h2></center></legend><br>						
							<div class="form-group">
							  <label class="col-md-4 control-label">Select Circle</label>  
								<div class="col-md-4 inputGroupContainer">								
									<select class="form-control" name = "circle_names" id="circle_names"  >
											<option value="Select">Select Circle</option>
											<?php
											foreach($circles as $row)
											{ 
											?>
												<option <?php if ($selected_circle_name == $row->circle_name ) echo 'selected' ; ?> value="<?php echo $row->circle_name; ?>"><?php echo $row->circle_name; ?></option>
												
											<?php
											}
											?>							
									</select>									
							  </div>
							</div>	
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Block</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_block" class="form-control" type="text" id="name_of_block" value="<?php echo $block; ?>">
									<!--HIDDEN ID FIELD -->
									<input name='id' id='id' value="<?php echo $b_s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickUpdateBlockData();">Update Data<span class="glyphicon glyphicon-send"></span></button>
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
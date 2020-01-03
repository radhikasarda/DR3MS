<?php

		foreach($data_item_details as $row)
		{
			$c_s_no = $row['c_s_no'];
			$circle_name = $row['circle_name'];
			log_message('info','########## circle_name:: '.$circle_name);
		}
			
?>

<div class = "row">
	<div class = "col-sm-2">
	</div>
	<div class = "col-sm-8">
		<div class="master-data-circle">
			<div class="container">
				<form class="well form-horizontal" id="circle_form">
					<fieldset>
						<legend><center><h2><b>Master Data Entry For Circle</b></h2></center></legend><br>						

							<div class="form-group">
							  <label class="col-md-4 control-label">Name of Circle</label>  
								<div class="col-md-4 inputGroupContainer">							 
									<input name="name_of_circle" class="form-control" type="text" id="name_of_circle"  value="<?php echo $circle_name; ?>">
									<!--HIDDEN INCIDENT ID FIELD -->
									<input name='id' id='id' value="<?php echo $c_s_no; ?>" class="form-control" type="hidden" >
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
								<div class="col-md-4"><br>
									<button type="button" class="btn btn-success form-control" onclick="return onClickAddCircleData();">Add Data<span class="glyphicon glyphicon-send"></span></button>
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

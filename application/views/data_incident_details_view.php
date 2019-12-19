<?php

		foreach($data_incident_details as $row)
		{
			$incident_id = $row['incident_id'];
			$circle_name = $row['circle_name'];
			$block_name = $row['block_name'];
			$gp_name = $row['gp_name'];
			$subject = $row['subject'];
			$location = $row['location'];
			$longitude = $row['longitude'];
			$latitude = $row['latitude'];
			$landmark = $row['landmark'];
			$incident_date = $row['incident_date'];
			$incident_time = $row['incident_time'];
			$reporting_date_time = $row['reporting_date_time'];
			$contact_no = $row['contact_no'];
			$reported_by = $row['reported_by'];
			$detailed_report = $row['detailed_report'];
			$image_dir_name = $row['image_dir_name'];
		}
			
?>
		<div class="container">
				<form class="well form-horizontal" id="contact_form">
					<fieldset>
						<legend><center><h2><b>Incident Details</b></h2></center></legend><br>
							<div class="form-group">
							  <label class="col-md-4 control-label">Circle</label>  
							  <div class="col-md-4 inputGroupContainer">
							  <div class="input-group">
							   <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
								<input  name="circle_name" class="form-control" value="<?php echo $circle_name; ?>" type="text" id="circle_name" readonly>
								</div>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label" >Block</label> 
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
										<input class="form-control" name= "block_name" id="block_name" value="<?php echo $block_name; ?>" type="text" readonly>							
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">GP</label> 
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
										<input class="form-control" name= "gp_name" id="gp_name" value="<?php echo $gp_name; ?>" type="text" readonly>						
									</div>
								</div>
							</div>							
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Location/Village Name</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
										<input  name="location" class="form-control" value="<?php echo $location; ?>" type="text" id="location" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Nearest Landmark</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
										<input  name="landmark" value="<?php echo $landmark; ?>" class="form-control"  type="text" id="landmark" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Latitude</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
										<input id="latitude" value="<?php echo $latitude; ?>" class="form-control"  type="text" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Longitude</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
										<input id="longitude" value="<?php echo $longitude; ?>" class="form-control"  type="text" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Subject</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
										<input  name="subject" value="<?php echo $subject; ?>" class="form-control"  type="text" id="subject" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Incident Date</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group" >
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input class="form-control" id="incident_date" name="incident_date" value="<?php echo $incident_date; ?>" type="text" readonly/>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Incident Time</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
										<input id="incident_time" value="<?php echo $incident_time; ?>" type="text" class="form-control input-small" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Reported By</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input  name="reported_by" value="<?php echo $reported_by; ?>" class="form-control"  type="text" id="reported_by" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Contact No.</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
										<input id="contact_no" value="<?php echo $contact_no; ?>" class="form-control" type="text" readonly>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label">Report in Brief</label>  
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
										<textarea class="form-control" id="report_brief" name="report_brief" rows="12" value="<?php echo $detailed_report; ?>" readonly></textarea>									
										<!--HIDDEN INCIDENT ID FIELD -->
										<div class="result" style="display:none;" id="incident_id" value="<?php echo $incident_id; ?>"></div> 
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">First Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
										<img id="uploaded_img_0" src="#" alt="No Image" />
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Second Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>							
										<img id="uploaded_img_1" src="#" alt="No Image" />
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Third Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
										<img id="uploaded_img_2" src="#" alt="No Image" />
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
							  <div class="col-md-4"><br>
								<button type="button" class="btn btn-success form-control" onclick="return onClickReportSend();">SEND REPORT<span class="glyphicon glyphicon-send"></span></button>
							  </div>
							</div>
							</fieldset>
							</form>
							</div>
								
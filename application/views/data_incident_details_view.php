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
			$image_1_path = $row['image_1_path'];
			$image_2_path = $row['image_2_path'];
			$image_3_path = $row['image_3_path'];
			$request_from_incident = $row['request_from_incident'];
			$request_from_guest = $row['request_from_guest'];
			log_message('info','##########INSIDE data_incident_details VIEW :: incident_id:: '.$incident_id);
			log_message('info','##########INSIDE data_incident_details VIEW :: request_from_incident:: '.$request_from_incident);
		}
			
?>
<style>
#uploaded_img_0:hover {opacity: 0.2;}
			#uploaded_img_1:hover {opacity: 0.2;}
			#uploaded_img_2:hover {opacity: 0.2;}

			/* The Modal (background) */
			.modal {
			  display: none; 
			  position: fixed; 
			  z-index: 1; 
			  padding-top: 100px; 
			  left: 0;
			  top: 0;
			  width: 100%; 
			  height: 100%; 
			  overflow: auto;
			  background-color: rgb(0,0,0); 
			  background-color: rgba(0,0,0,0.9); 
			}

			/* Modal Content (image) */
			.modal-content {
			  margin: auto;
			  display: block;
			  width: 80%;
			  max-width: 700px;
			}

			/* Caption of Modal Image */
			#caption {
			  margin: auto;
			  display: block;
			  width: 80%;
			  max-width: 700px;
			  text-align: center;
			  color: #ccc;
			  padding: 10px 0;
			  height: 150px;
			}

			@-webkit-keyframes zoom {
			  from {-webkit-transform:scale(0)} 
			  to {-webkit-transform:scale(1)}
			}

			@keyframes zoom {
			  from {transform:scale(0)} 
			  to {transform:scale(1)}
			}

			/* The Close Button */
			.close {
			  position: absolute;
			  top: 15px;
			  right: 35px;
			  color: #f1f1f1;
			  font-size: 40px;
			  font-weight: bold;
			  transition: 0.3s;
			}

			.close:hover,
			.close:focus {
			  color: #fff;
			  text-decoration: none;
			  cursor: pointer;
			}

			/* 100% Image Width on Smaller Screens */
			@media only screen and (max-width: 700px){
			  .modal-content {
				width: 100%;
			  }
			}
</style>
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
										<textarea class="form-control" id="report_brief" name="report_brief" rows="12" readonly><?php echo $detailed_report; ?></textarea>						
										<!--HIDDEN INCIDENT ID FIELD -->
										<input name='id' id='id' value="<?php echo $incident_id; ?>" class="form-control" type="hidden" >
									</div>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-sm-4 control-label">First Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group popup">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
										<img id="uploaded_img_0" class="img-thumbnail" onClick="return onClickImg1();" src="<?php if($image_1_path != null) echo $image_1_path; ?>" alt="No Image"/>
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Second Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group popup">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>							
										<img id="uploaded_img_1" class="img-thumbnail" onClick="return onClickImg2();" src="<?php if($image_2_path != null) echo $image_2_path; ?>" alt="No Image" />
									</div>
								</div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Third Image</label>
								<div class="col-md-4 inputGroupContainer">
									<div class="input-group popup">
										<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
										<img id="uploaded_img_2" class="img-thumbnail" onClick="return onClickImg3();" src="<?php if($image_3_path != null) echo $image_3_path; ?>" alt="No Image" />
									</div>
								</div>
							</div>
							<?php if($request_from_guest == "true"){ ?>
							<div class="form-group">
							  <label class="col-md-4 control-label"></label>
							  <div class="col-md-4"><br>						
								<button type="button" class="btn btn-danger form-control" onclick="return onClickBackToAllIncidents();">BACK</button>
							  </div>
							</div>
							<?php } else { ?>
									<?php if($request_from_incident == "true"){ ?>
									<div class="form-group">
									  <label class="col-md-4 control-label"></label>
									  <div class="col-md-4"><br>
										<button type="button" class="btn btn-success form-control" onclick="return onClickSendInstructions();">SEND INSTRUCTIONS<span class="glyphicon glyphicon-send"></span></button>								
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-md-4 control-label"></label>
									  <div class="col-md-4"><br>						
										<button type="button" class="btn btn-danger form-control" onclick="return onClickBackToAllIncidents();">BACK</button>
									  </div>
									</div>
									
									<?php } else { ?>
									<div class="form-group">
									  <label class="col-md-4 control-label"></label>
									  <div class="col-md-4"><br>
										<button type="button" class="btn btn-success form-control" onclick="return onClickBackToInbox();">BACK TO INBOX</button>
									  </div>
									</div>
							<?php } } ?>
						
							</fieldset>
							</form>
							</div>




					
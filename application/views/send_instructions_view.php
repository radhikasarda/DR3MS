<?php	

		foreach($data_send_instructions_details as $row)
		{
			$recipients = $row['recipients'];
			$subject = "INCIDENT: ".$row['subject'];
			$msg = $row['detailed_report'];
			$incident_date = $row['incident_date'];
			$incident_time = $row['incident_time'];
			$reported_by = $row['reported_by'];
			$incident_id = $row['incident_id'];
			log_message('info','##########INSIDE SEND INSTRUCTION VIEW :: msg:: '.$msg);
			
			
		}
		$incident_details_tag = "---------INCIDENT DETAILS---------";
?>

<div  class="container" style="overflow-x:auto;overflow-y:auto;height:800px;width:auto !important;">  
					<div class="panel panel-default">
						<div class="panel-body message">
							<form id="myForm" class="form-horizontal" role="form" >
								<div class="form-group" style="padding-left:18px;padding-right:18px;">
									<label for="to" class="col-sm-1 control-label">To:</label>
									<div class="col-sm-11" >
										<form method="post" id="multiple_select_form">
												<select name="framework" id="framework" class="selectpicker form-control " data-live-search="true" multiple>
												<?php
												foreach($recipients as $recipient){
													if(!is_null($recipient) && !empty($recipient)){
												?>
												<option value="<?php echo $recipient->uid; ?>"><?php echo $recipient->uid; ?>
												</option>
												<?php
												}}
												?>
												</select>
											 <input type="hidden" name="hidden_framework" id="hidden_framework" />
										</form>
									</div>
								</div>
								<div class="form-group" >
								<label for="subject" class="col-sm-1 control-label" style="padding-left:30px;">Subject:</label>
								<div class="col-sm-11">
									<input type="text" class="form-control select2-offscreen" name="subject_incident" id="subject_incident" value='<?php echo $subject; ?>' >
									<!--HIDDEN INCIDENT ID FIELD -->
									<input name='id' id='id' value="<?php echo $incident_id; ?>" class="form-control" type="hidden" >
								</div>
								</div>							  						
							<br>
							<br>
							<br>
							<div class="col-sm-11 col-sm-offset-1">
							<div class="form-group">
								<textarea class="form-control" id="message" name="body" rows="12"><?php echo "\n \n \n \n"; echo $incident_details_tag; echo "\n"; echo $msg; echo "\n"; echo "Incident Date:: "; echo $incident_date;echo "\n"; echo "Incident Time:: "; echo $incident_time;echo "\n"; echo "Reported By:: "; echo $reported_by; ?></textarea>
							</div>
							</div>
							<div class="col-sm-11 col-sm-offset-1">
							<div class="form-group" >	
							<button type="button" class="btn btn-success" onClick="onClickSendMessage();" id="btn-send">Send&nbsp;<i class='glyphicon glyphicon-send' aria-hidden='true'></i></button>
							
							<button type="button" class="btn btn-danger" onClick="onClickReset();" id="btn-reset">Reset&nbsp;<i class='glyphicon glyphicon-repeat' aria-hidden='true'></i></button>
							<button type="button" class="btn btn-warning" onClick="onClickBack();" id="btn-reset">Back&nbsp;<i class='glyphicon glyphicon-arrow-left' aria-hidden='true'></i></button>
							</div>
							</div>
							</form>
					</div>
				</div>
			</div>

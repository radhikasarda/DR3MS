<?php

		foreach($data_recieved_msg_details as $row)
		{
			$from = $row['msg_from'];
			$subject = $row['subject'];
			$date = $row['date'];
			$msg_body = $row['msg_body'];
			$message_id = $row['message_id'];
			$incident_id = $row['incident_id'];
		}
		echo "<div style='width:100%;'>";
		echo "<p><font size='5'><strong><u>SUBJECT</u> :&ensp;";echo $subject; echo "</strong></p>";
		echo "<p><font size='4'><strong><u>From</u> :&ensp;";echo $from; echo "</strong></p>";
		echo "<p><font size='3'><strong><u>Date</u> :&ensp;";echo $date; echo "</strong></p>";		
		echo "<br>";
		if(isset($incident_id)){echo "<button type='button' class='btn btn-info' id='incident_btn' onClick='return onClickViewIncident();'>View Incident Details&nbsp;</button>&ensp;";}
		
		echo "<div class='form-group' style='margin-top:50px;'>";
				echo "<p><font size='3'><strong>Message :&ensp;</strong></p>";
				echo "<textarea class='form-control' readonly rows='10' cols='50' style='overflow-y: scroll;'>";echo $msg_body; echo"</textarea>";
				echo "<input type='hidden' class='form-control select2-offscreen' name='id' id='id' value='$message_id'>";
				echo "<input type='hidden' class='form-control select2-offscreen' name='inc_id' id='inc_id' value='$incident_id'>";
		echo "</div>";
		echo "<div class='form-group' id='buttons'>";	
				echo "<button type='button' class='btn btn-success' onClick='return onClickInboxReply();'>Reply&nbsp;<i class='glyphicon glyphicon-arrow-left' aria-hidden='true'></i></button>&ensp;";
				echo "<button type='button' class='btn btn-default' onClick='return onClickInboxForward();'>Forward&nbsp;<i class='glyphicon glyphicon-arrow-right' aria-hidden='true'></i></button>&ensp;";
				//echo "<button type='button' class='btn btn-danger' onClick='onClickDelete();'>Delete&nbsp;<i class='glyphicon glyphicon-trash' aria-hidden='true'></i></button>";
		echo "</div>";
		echo "</div>";

?>	
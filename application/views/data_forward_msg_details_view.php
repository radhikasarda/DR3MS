<?php	

		foreach($data_forward_msg_details as $row)
		{
			$recipients = $row['recipients'];
			$subject = "Fwd: ".$row['subject'];
			$msg = nl2br("---------- Forwarded message ---------\n".$row['msg_body'],false);
			$message_id = $row['message_id'];
		}
	
		echo "<form id='myForm' class='form-horizontal' role='form' >";
			
			echo "<div class='form-group' style='padding-left:18px;padding-right:18px;'>";
				
				echo "<label for='to' class='col-sm-1 control-label'>To:</label>";
				
				echo "<div class='col-sm-11'>";
					echo "<form method='post' id='multiple_select_form'>";
						
						echo "<select name='framework' id='framework' class='selectpicker form-control' data-live-search='true' multiple>";
	
							foreach($recipients as $recipient)
							{
								if(!is_null($recipient) && !empty($recipient))
								{
								echo "<option value='$recipient->uid;'>";echo $recipient->uid;echo "</option>";
								}	
							}
						echo "</select>";
						echo "<input type='hidden' name='hidden_framework' id='hidden_framework' />";
					echo "</form>";
				echo "</div>";
			echo "</div>";
		
			echo "<div class='form-group' >";
				echo "<label for='subject' class='col-sm-1 control-label' style='padding-left:60px;'>Subject:</label>";
					echo "<div class='col-sm-11'>";
							echo "<input type='text' class='form-control select2-offscreen' name='subject' id='subject' value='$subject'>";
							echo "<input type='hidden' class='form-control select2-offscreen' name='id' id='id' value='$message_id'>";
					echo "</div>";
			echo "</div>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			
			echo "<div class='col-sm-11 col-sm-offset-1' >";
				echo "<div class='form-group' >";
					echo "<textarea class='form-control' id='message' name='body' rows='12'>$msg</textarea>";
				echo "</div>";
			echo "</div>";
			echo "<div class='col-sm-11 col-sm-offset-1'>";
				echo "<div class='form-group' >";	
					echo "<button type='button' class='btn btn-success' onClick='return onClickSend();'>Send&nbsp;<i class='fa fa-paper-plane' aria-hidden='true'></i></button>&ensp;";
					echo "<button type='button' class='btn btn-danger' onClick='return onClickDelete();'>Delete&nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>";
				echo "</div>";
			echo "</div>";
		echo "</form>";
?>				

<?php	

		foreach($data_sent_msg_details as $row)
		{
			$to = $row['to'];
			$subject = $row['subject'];
			$date = $row['date'];
			$msg_body = $row['msg_body'];
			log_message('info','##########INSIDE VIEWWWWWWW:: ');
		}
		echo "<div style='width:100%;'>";
		echo "<p><font size='5'><strong><u>SUBJECT</u> :&ensp;";echo $subject; echo "</strong></p>";
		echo "<p><font size='4'><strong><u>TO</u> :&ensp;";echo $to; echo "</strong></p>";
		echo "<p><font size='3'><strong><u>Date</u> :&ensp;";echo $date; echo "</strong></p>";
		
		echo "<br>";
		echo "<div class='form-group' style='margin-top:50px;'>";
				echo "<p><font size='3'><strong>Message :&ensp;</strong></p>";
				echo "<textarea class='form-control' readonly rows='10' cols='50' style='overflow-y: scroll;'>";echo $msg_body; echo"</textarea>";
		echo "</div>";
		echo "<div class='form-group'>";	
				echo "<button type='submit' class='btn btn-success' onClick='onClickSend();'>Reply&nbsp;<i class='fa fa-reply' aria-hidden='true'></i></button>&ensp;";
				echo "<button type='submit' class='btn btn-default' onClick='onClickSend();'>Forward&nbsp;<i class='fa' aria-hidden='true'>&#xf064;</i></button>&ensp;";
				echo "<button type='submit' class='btn btn-danger' onClick='onClickSend();'>Delete&nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button>";
		echo "</div>";
		echo "</div>";
?>
<?php			

				echo "<tbody style ='cursor:pointer;'>";
				echo "<tr>";
					echo "<th style='display:none;'>"; echo "<strong>Sl No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>UserId</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Activity Date & Time</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>IP Address</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Activity</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_audit_trail_report as $row)
				{
					echo "<tr>";
					
					echo "<td class = 's_no' style='display:none;'>".$row['s_no']."</td>";
					
					echo "<td class = 'userid'>".$row['userid']."</td>";

					echo "<td class = 'activity_date_time'>".$row['activity_date_time']."</td>";
					
					echo "<td class = 'activity_ip'>".$row['activity_ip']."</td>";

					echo "<td class = 'activity'>".$row['activity']."</td>";

					echo "</tr>";
				}
				
				echo "</tbody>";
			
					
?>

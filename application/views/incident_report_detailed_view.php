<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>GP</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Location OR Village Name</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Longitude</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Latitude</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Landmark</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Incident Date</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Incident Time</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Reporting Date and Time</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Reported By</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No.</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_incident_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['gp_name']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['gp_name']."</td>";
					}
					
					if(is_null($row['location_village_name']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['location_village_name']."</td>";
					}
					
					if(is_null($row['longitude']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['longitude']."</td>";
					}
					
					if(is_null($row['latitude']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['latitude']."</td>";
					}
					
					if(is_null($row['landmark']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['landmark']."</td>";
					}
					
					if(is_null($row['incident_date']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['incident_date']."</td>";
					}
					
					if(is_null($row['incident_time']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['incident_time']."</td>";
					}
					
					if(is_null($row['reporting_date_time']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['reporting_date_time']."</td>";
					}
					
					if(is_null($row['reported_by']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['reported_by']."</td>";
					}
					
					if(is_null($row['phone_no']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['phone_no']."</td>";
					}
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
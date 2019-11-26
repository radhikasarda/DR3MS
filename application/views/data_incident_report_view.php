<?php			
		//if((isset($data_report_circlewise)) && (!is_null($data_report_circlewise)))
		//{
				echo "<tbody style ='cursor:pointer;'>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Circle</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Block</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GP</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Location</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Incident Date</strong>"; echo "</th>";
					echo "<th style= 'display:none;'>"; echo "<strong>Incident Id</strong>";	echo "</th>";
					echo "<th>";	echo "</th>";
				echo "</tr>";
				
				foreach($data_incident_report as $row)
				{
					echo "<tr>";

					if(is_null($row['circle_name']))
					{
						echo "<td class = 'circle'>".$blank."</td>";
					}
					else
					{
					echo "<td class = 'circle'>".$row['circle_name']."</td>";
					}
					
					if(is_null($row['block']))
					{
						echo "<td class = 'block'>".$blank."</td>";
					}
					else
					{
					echo "<td class = 'block'>".$row['block']."</td>";
					}
					
					if(is_null($row['gp']))
					{
						echo "<td class = 'gp'>".$blank."</td>";
					}
					else
					{
						echo "<td class = 'gp'>".$row['gp']."</td>";
					}
										
					if(is_null($row['location']))
					{
						echo "<td class = 'location'>".$blank."</td>";
					}
					else
					{
						echo "<td class = 'location'>".$row['location']."</td>";
					}
					
					if(is_null($row['incident_date']))
					{
						echo "<td class = 'incident_date'>".$blank."</td>";
					}
					else
					{
						echo "<td class = 'incident_date'>".$row['incident_date']."</td>";
					}
					if(is_null($row['incident_id']))
					{
						echo "<td class = 'incident_id' style= 'display:none;'>".$blank."</td>";
					}
					else
					{
						echo "<td class = 'incident_id' style= 'display:none;'>".$row['incident_id']."</td>";
					}
					echo "<td><button onClick=\"OnClickIncidentReportViewDetails();\"><strong>View In Details</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
			
					
?>

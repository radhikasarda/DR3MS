<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Village Name</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Location of Telecom.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Service Provider</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['village_name_tele']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['village_name_tele']."</td>";
					}
					
					if(is_null($row['location_of_telecom']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['location_of_telecom']."</td>";
					}
					
					if(is_null($row['name_of_service_provider']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['name_of_service_provider']."</td>";
					}

					echo "</tr>";
				}
					echo "</tbody>";
?>
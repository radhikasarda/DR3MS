<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Name of Village</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Location</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GPS Points</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Provided by Govt./Private</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Provider</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['village_name']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['village_name']."</td>";
					}
					
					if(is_null($row['location']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['location']."</td>";
					}
					
					if(is_null($row['gps_point']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['gps_point']."</td>";
					}
					
					if(is_null($row['provider']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['provider']."</td>";
					}
					
					if(is_null($row['name_of_provider']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['name_of_provider']."</td>";
					}
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
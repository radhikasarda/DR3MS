<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Village Name</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Nature of Disaster</strong>"; echo "</th>";
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
					
					if(is_null($row['nature_of_disaster']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['nature_of_disaster']."</td>";
					}
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
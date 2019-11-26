<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Name Of Embankment</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Status</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Village Coverage</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['name_of_embankment']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['name_of_embankment']."</td>";
					}
					
					if(is_null($row['status']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['status']."</td>";
					}
					
					if(is_null($row['village_coverage']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['village_coverage']."</td>";
					}
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
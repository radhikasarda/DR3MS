<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name Of Embankment</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Status</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Village Coverage</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Edit</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Delete</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";
					
					echo "<td class = 's_no' style = 'display:none;'>".$row['s_no']."</td>";
					
					if(is_null($row['gp_no']))
					{
						echo "<td style = 'display:none;'>".$blank."</td>";
					}
					else
					{
					echo "<td style = 'display:none;'>".$row['gp_no']."</td>";
					}
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
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
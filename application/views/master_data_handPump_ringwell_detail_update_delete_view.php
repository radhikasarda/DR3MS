<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Village</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Location</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GPS Points</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Provided by Govt./Private</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Provider</strong>"; echo "</th>";
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
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
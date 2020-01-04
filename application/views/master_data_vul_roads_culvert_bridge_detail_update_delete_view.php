<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Vulnerable Roads</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Vulnerable Culverts</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Vulnerable Bridges</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Status</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Edit</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Delete</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";
					
					
					if(is_null($row['gp_no']))
					{
						echo "<td style = 'display:none;'>".$blank."</td>";
					}
					else
					{
					echo "<td style = 'display:none;'>".$row['gp_no']."</td>";
					}
					
					if(is_null($row['vulnerable_roads']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['vulnerable_roads']."</td>";
					}
					
					if(is_null($row['vulnerable_culvert']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['vulnerable_culvert']."</td>";
					}
					if(is_null($row['vulnerable_bridges']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['vulnerable_bridges']."</td>";
					}
					if(is_null($row['status']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['status']."</td>";
					}
					echo "<td><button onClick=\"OnClickEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
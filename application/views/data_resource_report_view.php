<?php			

				echo "<tbody style ='cursor:pointer;'>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Circle</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Block</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GP</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Resource Type</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Quantity of Resource Available</strong>"; echo "</th>";
					echo "<th>";	echo "</th>";
				echo "</tr>";
				
				foreach($data_resource_report as $row)
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
					
					if(is_null($row['resource_type']))
					{
						echo "<td class = 'resource'>".$blank."</td>";
					}
					else
					{
						echo "<td class = 'resource'>".$row['resource_type']."</td>";
					}
					
					if(is_null($row['resource_quantity']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['resource_quantity']."</td>";
					}
					
					echo "<td><button onClick=\"OnClickViewDetails();\"><strong>View In Details</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
			
					
?>

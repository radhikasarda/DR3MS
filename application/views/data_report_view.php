<?php			
		//if((isset($data_report_circlewise)) && (!is_null($data_report_circlewise)))
		//{
				$blank = "0";
				echo "<tr>";
					echo "<th>"; echo "<strong>Circle</strong>"; echo "</td>";
					echo "<th>"; echo "<strong>Block</strong>"; echo "</td>";
					echo "<th>"; echo "<strong>GP</strong>"; echo "</td>";
					echo "<th>"; echo "<strong>Resource Type</strong>"; echo "</td>";
					echo "<th>"; echo "<strong>Quantity of Resource Available</strong>"; echo "</td>";
				echo "</tr>";
				
				foreach($data_report as $row)
				{
					echo "<tr>";
					
					if(is_null($row['circle_name']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['circle_name']."</td>";
					}
					
					if(is_null($row['block']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['block']."</td>";
					}
					
					if(is_null($row['gp']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['gp']."</td>";
					}
					
					if(is_null($row['resource_type']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['resource_type']."</td>";
					}
					
					if(is_null($row['resource_quantity']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['resource_quantity']."</td>";
					}
					
					echo "</tr>";
				}		
		//}	
?>

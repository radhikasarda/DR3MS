<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Name Of Community Hall</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Capacity to Hold People-1</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Capacity to Hold People-2</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GPS Points</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['community_hall']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['community_hall']."</td>";
					}
					
					if(is_null($row['capacity_to_hold_people1']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['capacity_to_hold_people1']."</td>";
					}
					
					if(is_null($row['address']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['address']."</td>";
					}
					
					if(is_null($row['ph_no_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['ph_no_of_owner']."</td>";
					}
					
					if(is_null($row['capacity_to_hold_people2']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['capacity_to_hold_people2']."</td>";
					}
					
					if(is_null($row['gps_point']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['gps_point']."</td>";
					}
					echo "</tr>";
				}
					echo "</tbody>";
?>
<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Raised Platform</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. Of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Capacity to hold people</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GPS Point</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['raised_platform']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['raised_platform']."</td>";
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
					
					if(is_null($row['capacity_to_hold_people']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['capacity_to_hold_people']."</td>";
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
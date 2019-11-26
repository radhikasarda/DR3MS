<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Name Of item</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. Of Items</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Capacity</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['name_of_item']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['name_of_item']."</td>";
					}
					
					if(is_null($row['nos_of_items']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['nos_of_items']."</td>";
					}
					
					if(is_null($row['name_of_owners']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['name_of_owners']."</td>";
					}
					
					if(is_null($row['address_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['address_of_owner']."</td>";
					}
					
					if(is_null($row['ph_no_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['ph_no_of_owner']."</td>";
					}
					
					if(is_null($row['capacity_to_hold_people_']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['capacity_to_hold_people_']."</td>";
					}
					echo "</tr>";
				}
					echo "</tbody>";
?>
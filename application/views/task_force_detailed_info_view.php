<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Total Rev. Village</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total Govt. Land</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total Forest Land</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Task force/Designation</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Members</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['total_rev_village']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['total_rev_village']."</td>";
					}
					
					if(is_null($row['total_govt_land']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['total_govt_land']."</td>";
					}
					
					if(is_null($row['total_forest_land']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['total_forest_land']."</td>";
					}
					
					if(is_null($row['designation']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['designation']."</td>";
					}
					
					if(is_null($row['name_of_members']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['name_of_members']."</td>";
					}
					
					if(is_null($row['contact_no_of_members']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['contact_no_of_members']."</td>";
					}
					
					if(is_null($row['address_of_members']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['address_of_members']."</td>";
					}

					echo "</tr>";
				}
					echo "</tbody>";
?>
<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";					
					echo "<th>"; echo "<strong>Name Of item</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. Of Items</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Capacity</strong>"; echo "</th>";
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
					
					if(is_null($row['name_of_item']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['name_of_item']."</td>";
					}
					
					if(is_null($row['no_of_item']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['no_of_item']."</td>";
					}
					
					if(is_null($row['name_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['name_of_owner']."</td>";
					}
					
					if(is_null($row['address_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['address_of_owner']."</td>";
					}
					
					if(is_null($row['contact_no_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['contact_no_of_owner']."</td>";
					}
					
					if(is_null($row['capacity_to_hold_people']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['capacity_to_hold_people']."</td>";
					}
					
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
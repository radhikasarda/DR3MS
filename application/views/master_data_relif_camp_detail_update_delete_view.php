<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name of School</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. of Owner</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. of Classrooms</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Type of Building</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. of Toilets</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Source of drinking water</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Open Space</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Availability of Electricity</strong>"; echo "</th>";
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
					
					if(is_null($row['name_of_school']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['name_of_school']."</td>";
					}
					
					if(is_null($row['address_of_camp']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['address_of_camp']."</td>";
					}
					
					if(is_null($row['ph_no_of_owner']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['ph_no_of_owner']."</td>";
					}
					
					if(is_null($row['nos_of_class_room']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['nos_of_class_room']."</td>";
					}
					
					if(is_null($row['type_of_building']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['type_of_building']."</td>";
					}
					
					if(is_null($row['nos_of_toilets']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['nos_of_toilets']."</td>";
					}
					
					if(is_null($row['sources_of_drinking_water']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['sources_of_drinking_water']."</td>";
					}
					if(is_null($row['open_space']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['open_space']."</td>";
					}
					if(is_null($row['availability_of_electricity']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['availability_of_electricity']."</td>";
					}
					
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
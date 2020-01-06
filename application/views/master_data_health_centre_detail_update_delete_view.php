<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Name Of Health Centre</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Address</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Contact No. of Health Centre</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. of Doctors</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. of anm</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Building Type</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. of Bed</strong>"; echo "</th>";
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
					if(is_null($row['name_of_health_centre']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['name_of_health_centre']."</td>";
					}
					
					if(is_null($row['address']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['address']."</td>";
					}
					
					if(is_null($row['ph_no_of_health_centre']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['ph_no_of_health_centre']."</td>";
					}
					
					if(is_null($row['no_of_doctors']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['no_of_doctors']."</td>";
					}
					
					if(is_null($row['nos_of_anm']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['nos_of_anm']."</td>";
					}
					
					if(is_null($row['building_type']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['building_type']."</td>";
					}
					
					if(is_null($row['nos_of_bed']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['nos_of_bed']."</td>";
					}
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
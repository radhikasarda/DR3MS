<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					echo "<th style = 'display:none;'>"; echo "<strong>SL NO</strong>"; echo "</th>";
					echo "<th style = 'display:none;'>"; echo "<strong>GP NO</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total LP School</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total ME School</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total High School</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total HS School</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Total No. of College</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Others</strong>"; echo "</th>";
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
					if(is_null($row['total_lp_School']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['total_lp_School']."</td>";
					}
					
					if(is_null($row['total_me_School']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['total_me_School']."</td>";
					}
					
					if(is_null($row['total_high_school']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['total_high_school']."</td>";
					}
					
					if(is_null($row['total_hs_School']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['total_hs_School']."</td>";
					}
					
					if(is_null($row['total_nos_of_college']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['total_nos_of_college']."</td>";
					}
					
					if(is_null($row['others']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['others']."</td>";
					}
					echo "<td><button onClick=\"OnClickResourceEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickResourceDelete();\"><strong>DELETE</strong></button></td>";
					echo "</tr>";
				}
					echo "</tbody>";
?>
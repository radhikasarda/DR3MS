<?php
				echo "<tbody>";
				echo "<tr>";					
					echo "<th>"; echo "<strong>Circle No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Circle name</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_item_details as $row)
				{
					echo "<tr>";
		
					echo "<td>".$row['c_s_no']."</td>";
					
					echo "<td>".$row['circle_name']."</td>";
					
					echo "</tr>";
				}
				
				echo "</tbody>";
?>
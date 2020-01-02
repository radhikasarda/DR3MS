<?php
				echo "<tbody>";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Block No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Circle No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Block name</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_item_details as $row)
				{
					echo "<tr>";
					
					echo "<td>".$row['b_s_no']."</td>";
					
					echo "<td>".$row['c_s_no']."</td>";
					
					echo "<td>".$row['block']."</td>";
					
					echo "</tr>";
				}
					
				echo "</tbody>";
?>
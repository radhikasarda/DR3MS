<?php
				echo "<tbody>";
				echo "<tr>";
					echo "<th>"; echo "<strong>GP No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Block No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>GP name</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_item_details as $row)
				{
					echo "<tr>";
					
					echo "<td>".$row['gp_no']."</td>";
						
					echo "<td>".$row['b_s_no']."</td>";
					
					echo "<td>".$row['gp_name']."</td>";
					
					echo "</tr>";
				}
					
				echo "</tbody>";
?>
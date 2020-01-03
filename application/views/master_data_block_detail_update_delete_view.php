<?php
				echo "<tbody>";
				echo "<tr>";					
					echo "<th>"; echo "<strong>Block No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Circle No.</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Block name</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Edit</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Delete</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_item_details as $row)
				{
					echo "<tr>";
					
					echo "<td class = 'id'>".$row['b_s_no']."</td>";
					
					echo "<td>".$row['c_s_no']."</td>";
					
					echo "<td>".$row['block']."</td>";
					
					echo "<td><button onClick=\"OnClickEdit();\"><strong>EDIT</strong></button></td>";
					
					echo "<td><button onClick=\"OnClickDelete();\"><strong>DELETE</strong></button></td>";
					
					echo "</tr>";
				}
					
				echo "</tbody>";
?>
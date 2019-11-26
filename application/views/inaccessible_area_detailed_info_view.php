<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Inaccesible Area</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['inaccessible_area']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['inaccessible_area']."</td>";
					}
					
					echo "</tr>";
				}
					echo "</tbody>";
?>
<?php
				echo "<tbody>";
				$blank = "0";
				echo "<tr>";
					
					echo "<th>"; echo "<strong>Total Population</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Male Child</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Female Child</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Male Adult</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Female Adult</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Male Old</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Female Old</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>No. Of BPL families</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Families with Pucca House</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Families with Kutcha House</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Landless Families</strong>"; echo "</th>";
					echo "<th>"; echo "<strong>Homeless Families</strong>"; echo "</th>";
				echo "</tr>";
				
				foreach($data_report_detailed_info as $row)
				{
					echo "<tr>";

					if(is_null($row['total_pop']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['total_pop']."</td>";
					}
					
					if(is_null($row['male_child']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
					echo "<td>".$row['male_child']."</td>";
					}
					
					if(is_null($row['female_child']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['female_child']."</td>";
					}
					
					if(is_null($row['male_adult']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['male_adult']."</td>";
					}
					
					if(is_null($row['female_adult']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['female_adult']."</td>";
					}
					
					if(is_null($row['male_old']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['male_old']."</td>";
					}
					
					if(is_null($row['female_old']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['female_old']."</td>";
					}
					
					if(is_null($row['nos_of_bpl_families']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['nos_of_bpl_families']."</td>";
					}
					
					if(is_null($row['families_with_pucca_house']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['families_with_pucca_house']."</td>";
					}
					
					if(is_null($row['families_with_Kutcha_house']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['families_with_Kutcha_house']."</td>";
					}
					
					if(is_null($row['landless_family']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['landless_family']."</td>";
					}
					
					if(is_null($row['homeless_family']))
					{
						echo "<td>".$blank."</td>";
					}
					else
					{
						echo "<td>".$row['homeless_family']."</td>";
					}
					echo "</tr>";
				}
					echo "</tbody>";
?>
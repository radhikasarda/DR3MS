
<div class="row">
<?php	
		$start = $start;
		$end = $end;
		$total_records = $total_records;
		$total_gp = $total_gp;
		$no_gp_per_page = $no_gp_per_page;
		$selected_district = $this->session->userdata('selected_district');
		if($total_gp <= $end)
		{
			$end = $total_gp;
		}
		$blank = "0";
		
?>		
<div class="col-md-12">
		<div class="row">
		<div class="pagination" id="pagination">
			<h4><?php 
			echo "Showing (".$start."-".$end.") GP Details out of total ".$total_gp." GP in ".strtoupper($selected_district)." District"; ?></h4>
			<input type="button" class="button" value="<< Previous" style="margin-top:10px;position: absolute; left: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;" onclick="return GetPreviousData(<?php echo $end+1 .",".$start ?>);">
			<input type="button" class="button" value="Next >>" style="margin-top:10px;position: absolute; right: 0;background-color: #FFB700;border: none; padding: 5px 20px;font-weight:bold;" onclick="return GetNextData(<?php echo $end+1 .",".$start ?>);">
			<br>
		</div>
		
			<table  class="table table-striped table-bordered" id="report-table">									
				<thead style="background-color: black;color: white;">				
				<tr>
					<th><strong>Circle</strong></th>
					<th><strong>Block</strong></th>
					<th><strong>GP</strong></th>
					<th><strong>Resource Type</strong></th>
					<th><strong>Quantity of Resource Available</strong></th>
					<th></th> 
				</tr>
				<tbody style ='cursor:pointer;'>
				<?php
					foreach ($data_resource_report as $row): 
						
					?>
					<tr>
					<?php if(is_null($row['circle_name'])){ ?>
					
						<td class = 'circle'><?= $blank ?></td>

					<?php } else { ?>
					
						<td class = 'circle'><?= $row['circle_name']?></td>
						
					<?php } if(is_null($row['block'])) { ?>
					
						<td class = 'block'><?= $blank ?></td>
					
					<?php } else { ?>
					
						<td class = 'block'><?= $row['block']?></td>
					
					<?php } if(is_null($row['gp'])) { ?>
					
						<td class = 'gp'><?= $blank ?></td>

					<?php } else { ?>
					
						<td class = 'gp'><?= $row['gp']?></td>
					
					<?php } if(is_null($row['resource_type'])) { ?>
				
						<td class = 'resource'><?= $blank ?></td>
					
					<?php } else { ?>
					
						<td class = 'resource'><?= $row['resource_type']?></td>
					
					<?php } if(is_null($row['resource_quantity'])) { ?>
					
						<td><?= $blank ?></td>

					<?php } else { ?>
					
						<td><?= $row['resource_quantity']?></td>
					
					<?php } ?>
					
						<td><button onClick="OnClickViewDetails();"><strong>View In Details</strong></button></td>
					</tr>
					<?php 
						endforeach; 
						log_message('info','##########INSIDE data_audit_trail_report FUNC::end:: '.$end);
					 ?>
					 					
					<input type='hidden' class='form-control select2-offscreen' name='last_end' id='last_end' value='<?php echo $end; ?>'>					 
					<input type='hidden' class='form-control select2-offscreen' name='last_start' id='last_start' value='<?php echo $start; ?>'>
					</tbody>
			</table>
		</div>
	</div>
</div>
	


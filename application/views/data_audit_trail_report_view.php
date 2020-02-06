
							
<div class="row">
	<?php
		  $start = $start;
		  $end = $end;
		  $total_records = $total_records;	
		  if($total_records <= $end)
		  {
			 $end = $total_records;
		  }
	?>
	<div class="col-md-12">
		<div class="row">
			<h4><?php 
			echo "Showing (".$start."-".$end.") records out of ".$total_records; ?></h4>
			<table  class="table table-striped table-bordered">									
				<thead>
				
				<tr>
					<th style='display:none;'><strong>S No.</strong></th>
					<th><strong>Sl No.</strong></th>
					<th><strong>UserId</strong></th>
					<th><strong>Activity Date & Time</strong></th>
					<th><strong>IP Address</strong></th>
					<th><strong>Activity</strong></th>
				</tr>
				</thead>
				<tbody>			
					<?php
						$count =  $start;
						foreach ($audit as $audit): 
					?>
							<tr>
							
							<td class = 's_no' style='display:none;'><?= $audit->s_no ?></td>
							
							<td class = 'sl_no'><?= $count ?></td>
							
							<td class = 'userid'><?= $audit->userid ?></td>

							<td class = 'activity_date_time'><?= $audit->activity_date_time ?></td>
						
							<td class = 'activity_ip'><?= $audit->activity_ip ?></td>

							<td class = 'activity'><?= $audit->activity ?></td>

							</tr>
					<?php 
						$count ++ ;
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
<div class="pagination">
	<input type="button" class="button" value="<< Previous" onclick="return GetPreviousData(<?php echo $end+1 .",".$start ?>);">
	<input type="button" class="button" value="Next >>" onclick="return GetNextData(<?php echo $end+1 .",".$start ?>);">
</div>							
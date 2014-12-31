<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i><span class="panel_break"></span> Data Over Time</h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 bg-white con-datatables">
				<table class="table table-striped table-bordered font-11 datatables" id="datatable_lembur">
					<thead>
						<tr>
							<th style="text-align:center;">No.</th>
							<th style="text-align:center;">Over Time No.</th>
							<th style="text-align:center;">Over Time In</th>
							<th style="text-align:center;">Over Time Out</th>
							<th style="text-align:center;">Duration</th>
							<th style="text-align:center;">Reason</th>
							<th style="text-align:center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($data_lembur as $d)
						{
							$assigned_time = date('Y-m-d H:i:s', strtotime($d['lembur_time_in']));
							$completed_time= date('Y-m-d H:i:s', strtotime($d['lembur_time_out']));

							$d1 = new DateTime($assigned_time);
							$d2 = new DateTime($completed_time);
							$interval = $d2->diff($d1);
							// $interval->format('%d days, %H hours, %I minutes, %S seconds')
							?>
							<tr>
								<th style="text-align:center; width:4%;"><?php echo $n;?></th>
								<td style="text-align:center"><?php echo $d['lembur_no']; ?></td>
								<td style="text-align:center"><?php echo $d['lembur_time_in']; ?></td>
								<td style="text-align:center"><?php echo $d['lembur_time_out']; ?></td>
								<td style="text-align:center"><?php echo $interval->format('%H hours, %I minutes, %S seconds'); ?></td>
								<td style="text-align:left"><?php echo $d['lembur_reason']; ?></td>
								<td style="text-align:center;">
									<a href="#datatable_lembur" onClick="cancel_lembur(this.id)" id="<?php echo $d['lembur_no']; ?>" class="btn btn-xs btn-danger">
										Cancel
									</a>
								</td>
							</tr>
							<?php
							$n++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var url_cancel_lembur = "<?php echo site_url().'hcis/c_hcis_lembur/cancel_lembur';?>";
</script>
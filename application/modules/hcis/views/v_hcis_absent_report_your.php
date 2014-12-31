<div class="row">
	<div class="col-lg-5">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i><span class="panel_break"></span> Form Generate Report</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-12">
						<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url().'hcis/c_hcis_absent_report/generate_your_absent';?>" onSubmit="return confirm('Are you sure want to request ?');">
							<div class="form-group">
								<div class="row">
									<label class="col-lg-4 control-label-left">Date From</label>
									<div class="col-lg-6">
										<input type="text" name="date_from" id="date_from" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_from) ? $p_date_from : "" ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<label class="col-lg-4 control-label-left">Date Thru</label>
									<div class="col-lg-6">
										<input type="text" name="date_thru" id="date_thru" class="form-control datepicker" autocomplete="off" required value="<?php echo isset($p_date_thru) ? $p_date_thru : "" ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-lg-12 text-center">
										<input type="submit" class="btn btn-primary" name="generate" value="Generate">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($data_absent))
{
	?>
	<div class="row">
		<div class="col-lg-12 bg-white con-datatables">
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-list"></i><span class="panel_break"></span> Result Generate Report</h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover table-striped table-bordered font-11 datatables">
							<thead>
								<tr>
									<th style="text-align:center;" class="col-lg-1">No.</th>
									<th style="text-align:center;">Date</th>
									<th style="text-align:center;">Punch In Time</th>
									<th style="text-align:center;">Punch Out Time</th>
									<th style="text-align:center;">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$n = 1;
								foreach ($data_absent as $d)
								{
									?>
									<tr>
										<th style="text-align:center"><?php echo $n;?></th>
										<td style="text-align:center"><?php echo $d['absen_date']; ?></td>
										<td style="text-align:center">
											<?php 
											if ($d['pi_late_flag']==1)
											{
												?>
												<span class="ttip" data-placement="top" title="<?php echo $d['pi_late_reason']; ?>">
													<?php echo $d['absen_punch_in_time']; ?>
												</span>
												<?php
											}
											else
											{
												echo $d['absen_punch_in_time']=="" ? "&nbsp;" : $d['absen_punch_in_time']; 
											}
											?>
										</td>
										<td style="text-align:center">
											<?php 
											if ($d['po_early_flag']==1)
											{
												?>
												<span class="ttip" data-placement="top" title="<?php echo $d['po_early_reason']; ?>">
													<?php echo $d['absen_punch_out_time']; ?>
												</span>
												<?php
											}
											else
											{
												echo $d['absen_punch_out_time']=="" ? "&nbsp;" : $d['absen_punch_out_time']; 
											}
											?>
										</td>
										<td style="text-align:center"><?php echo $d['absen_status']; ?></td>
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
	</div>
	<?php
}
?>
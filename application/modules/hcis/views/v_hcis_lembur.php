<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i><span class="panel_break"></span> Form Over Time</h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-12">
						<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url().'hcis/c_hcis_lembur/insert_lembur';?>" onSubmit="return confirm('Are you sure want to request ?');">
							<div class="form-group">
								<div class="row">
									<label class="col-lg-3 control-label-left">Over Time In</label>
									<div class="col-lg-4">
										<input type="text" name="lembur_time_in" id="lembur_time_in" class="form-control datetimepicker" autocomplete="off" required value="<?php echo isset($p_date_from) ? $p_date_from : "" ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<label class="col-lg-3 control-label-left">Over Time Out</label>
									<div class="col-lg-4">
										<input type="text" name="lembur_time_out" id="lembur_time_out" class="form-control datetimepicker" autocomplete="off" required value="<?php echo isset($p_date_thru) ? $p_date_thru : "" ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<label class="col-lg-3 control-label-left">Reason</label>
									<div class="col-lg-8">
										<textarea name="lembur_reason" id="lembur_reason" class="form-control animated" rows=2 required></textarea>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-md-12 text-center" style="padding:0">
										<input type="submit" class="btn btn-primary" name="submit" value="Submit">
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
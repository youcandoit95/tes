<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'sdh_nr/c_sdh_nr/take_request';?>" onSubmit="return confirm('Are you sure ?');">
	
	<input type="hidden" name="req_no" id="take_req_no" value="<?php echo $req_no; ?>">
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Estimate Time</label>
			<div class="col-xs-6 col-md-2" style="padding:0">
				<input type="text" name="req_est_time" class="form-control datetimepicker" autocomplete="off" required>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Priority</label>
			<div class="col-xs-6 col-md-10 bg-white" style="padding-top:10px; padding-bottom:10px; color:black;">
				<div class="col-xs-6 col-md-6" style="padding:0px; position:relative">
					<div class="row">
						<?php
						foreach ($req_priority as $rp)
						{
							?>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="radio" name="req_priority" value="<?php echo $rp['PRIORITY_NO'];?>" required>
									</span>
									<input type="text" class="form-control" value="<?php echo $rp['PRIORITY_NAME'];?>" readonly>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="form-group">
		<div class="row">
			<label class="col-sm-2 control-label">Priority Reason</label>
			<div class="col-xs-6 col-md-6" style="padding:0">
				<textarea name="req_priority_reason" class="form-control animated" id="req_priority_reason" required="" rows=2 maxlength=400 onKeyUp="count_length(this.id)"></textarea>
			</div>
		</div>
	</div>
	
		<div class="form-group" style="margin-top:-15px;">
			<div class="row">
				<label class="col-sm-2 control-label">&nbsp;</label>
				<div class="col-xs-6 col-md-6" style="padding:0">
					<div class="col-xs-6 col-md-2" style="padding:0; width:60px;">
						<input type="text" class="form-control" value=400 disabled="disabled" id="req_priority_reason_char_left">
					</div>
					<label style="margin-top:7px;">Character Left</label>
				</div>
			</div>
		</div>
	
	<div class="form-group">
		<div class="row">
			<div class="col-md-12 text-center" style="padding:0">
				<button type="submit" class="btn btn-primary" id="btn_submit_form">SUBMIT</button>
			</div>
		</div>
	</div>	
		
</form>
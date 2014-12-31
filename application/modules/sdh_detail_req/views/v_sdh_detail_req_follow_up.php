<?php
if ($menu_active=="on_process")
{
?>
	<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'sdh_op/c_sdh_op/follow_up_request';?>" onSubmit="return confirm('Are you sure ?');">
		
		<input type="hidden" name="req_no" id="take_req_no" value="<?php echo $req_no; ?>">
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-2 control-label">Set Status</label>
				<div class="col-xs-6 col-md-2" style="padding:0; width:auto">
					<select name="req_status" id="req_status" class="form-control" onchange="follow_up_on_process()" required>
						<option value="">Choose</option>
						<?php
						foreach ($data_req_status as $st)
						{
							?><option value="<?php echo $st['STATUS_NO']; ?>"><?php echo $st['STATUS_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>	
		
		<div class="form-group col_status_reason" style="display:none">
			<div class="row">
				<label class="col-sm-2 control-label">Status Reason</label>
				<div class="col-xs-6 col-md-6" style="padding:0">
					<textarea name="req_status_reason" class="form-control animated" id="req_status_reason" required="" rows=2 maxlength=400 onKeyUp="count_length(this.id)"></textarea>
				</div>
			</div>
		</div>
		
			<div class="form-group col_status_reason" style="margin-top:-15px; display:none;">
				<div class="row">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-xs-6 col-md-6" style="padding:0">
						<div class="col-xs-6 col-md-2" style="padding:0; width:60px;">
							<input type="text" class="form-control" value=400 disabled="disabled" id="req_status_reason_char_left">
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
	<?php
}
else if ($menu_active=="hold")
{
	?>
	<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'sdh_rr/c_sdh_rr/follow_up_request';?>" onSubmit="return confirm('Are you sure ?');">
		
		<input type="hidden" name="req_no" id="take_req_no" value="<?php echo $req_no; ?>">
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-2 control-label">Set Status</label>
				<div class="col-xs-6 col-md-2" style="padding:0; width:auto">
					<select name="req_status" id="req_status" class="form-control" onchange="follow_up_hold()" required>
						<option value="">Choose</option>
						<?php
						foreach ($data_req_status as $st)
						{
							?><option value="<?php echo $st['STATUS_NO']; ?>"><?php echo $st['STATUS_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>	
		
		<div class="form-group" style="display:none" id="con_req_est_time">
			<div class="row">
				<label class="col-sm-2 control-label">Estimate Time</label>
				<div class="col-xs-6 col-md-2" style="padding:0">
					<input type="text" name="req_est_time" id="req_est_time" class="form-control datetimepicker" autocomplete="off" required>
				</div>
			</div>
		</div>
		
		<div class="form-group col_status_reason" style="display:none">
			<div class="row">
				<label class="col-sm-2 control-label">Status Reason</label>
				<div class="col-xs-6 col-md-6" style="padding:0">
					<textarea name="req_status_reason" class="form-control animated" id="req_status_reason" required="" rows=2 maxlength=400 onKeyUp="count_length(this.id)"></textarea>
				</div>
			</div>
		</div>
		
			<div class="form-group col_status_reason" style="margin-top:-15px; display:none;">
				<div class="row">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-xs-6 col-md-6" style="padding:0">
						<div class="col-xs-6 col-md-2" style="padding:0; width:60px;">
							<input type="text" class="form-control" value=400 disabled="disabled" id="req_status_reason_char_left">
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
	<?php
}
else if ($menu_active=="revision")
{
	?>
	<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'sdh_rr/c_sdh_rr/follow_up_request';?>" onSubmit="return confirm('Are you sure ?');">
		
		<input type="hidden" name="req_no" id="take_req_no" value="<?php echo $req_no; ?>">
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-2 control-label">Set Status</label>
				<div class="col-xs-6 col-md-2" style="padding:0; width:auto">
					<select name="req_status" id="req_status" class="form-control" onchange="follow_up_revision()" required>
						<option value="">Choose</option>
						<?php
						foreach ($data_req_status as $st)
						{
							?><option value="<?php echo $st['STATUS_NO']; ?>"><?php echo $st['STATUS_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>	
		
		<div class="form-group" style="display:none" id="con_req_est_time">
			<div class="row">
				<label class="col-sm-2 control-label">Estimate Time</label>
				<div class="col-xs-6 col-md-2" style="padding:0">
					<input type="text" name="req_est_time" id="req_est_time" class="form-control datetimepicker" autocomplete="off" required>
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
	<?php
}
?>
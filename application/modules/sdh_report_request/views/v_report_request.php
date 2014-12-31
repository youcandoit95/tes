<?PHP
/* Error Form */ 
$VE = validation_errors();
if (!empty($VE))
{$VE_gone = "";}
else
{$VE_gone = "hide";}
/* End Error Form */

$sess_dml = $this->session->flashdata('status_dml_dept');
$msg_sess_dml = $this->session->flashdata('msg_status_dml_dept');
if (($sess_dml=="Y") AND (!empty($msg_sess_dml)))
{$class_dml = "";}
else
{$class_dml = "hide";}
?>
	
	<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?PHP echo site_url().'sdh_report_request/c_report_request/generate_report';?>">
	
		<div class="form-group">
			<div class="row">
				<label class="col-sm-4 control-label">Period</label>
				<div class="col-xs-6 col-md-3" style="padding:0">
					<input type="text" name="date_from" class="form-control datepicker" placeholder="date from" autocomplete="off">
				</div>
				<div class="col-xs-6 col-md-3" style="padding:0">
					<input type="text" name="date_thru" class="form-control datepicker" placeholder="date thru" autocomplete="off">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-4 control-label">Request Type</label>
				<div class="col-xs-6 col-md-4" style="padding:0">
					<select name="req_type" class="form-control" style="width:auto;">
						<option value="">ALL</option>
						<?php 
						foreach ($req_type as $rt)
						{
							?><option value="<?php echo $rt['TYPE_NO']; ?>"><?php echo $rt['TYPE_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-4 control-label">Request Category</label>
				<div class="col-xs-6 col-md-4" style="padding:0">
					<select name="req_category" class="form-control" style="width:auto;">
						<option value="">ALL</option>
						<?php 
						foreach ($req_category as $rc)
						{
							?><option value="<?php echo $rc['CATEGORY_NO']; ?>"><?php echo $rc['CATEGORY_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>
		
		<?php
		if ($this->session->userdata('user_level')!=2)
		{
			?>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-4 control-label">Request By</label>
					<div class="col-xs-6 col-md-4" style="padding:0">
						<select name="req_by" class="form-control" style="width:auto;">
							<option value="">ALL</option>
							<?php 
								foreach ($data_user_isd as $du)
								{
									?><option value="<?php echo $du['USER_NO']; ?>"><?php echo $du['USER_FNAME']; ?></option><?php
								}
							?>
						</select>
					</div>
				</div>
			</div>
		<?php
		}
		else if ($this->session->userdata('user_level')==2)
		{
			?>
			<input type="hidden" name="req_by" value="<?php echo $this->session->userdata('user_no'); ?>">
			<?php
		}
		?>
		
		<?php
		if ($this->session->userdata('user_level')>1)
		{
			?>
			<div class="form-group">
				<div class="row">
					<label class="col-sm-4 control-label">Request PIC</label>
					<div class="col-xs-6 col-md-4" style="padding:0">
						<select name="req_pic" class="form-control" style="width:auto;">
							<option value="">ALL</option>
							<?php 
								foreach ($req_pic as $rp)
								{
									?><option value="<?php echo $rp['USER_NO']; ?>"><?php echo $rp['USER_FNAME']; ?></option><?php
								}
							?>
						</select>
					</div>
				</div>
			</div>
		<?php
		}
		else if ($this->session->userdata('user_level')==1)
		{
			?>
			<input type="hidden" name="req_pic" value="<?php echo $this->session->userdata('user_no'); ?>">
			<?php
		}
		?>
		<div class="form-group">
			<div class="row text-center">
				<button type="submit" class="btn btn-primary">Generate</button>
			</div>	
		</div>	
		
	</form>
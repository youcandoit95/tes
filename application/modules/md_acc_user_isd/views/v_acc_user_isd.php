<div class="row" id="con_btn" style="margin-bottom:10px;">
	<button type="button" class="btn btn-primary" onClick="open_fad()">NEW ACCESS</button>
</div>

<div class="row" id="con_fad" style="display:none;">
	<form class="form-horizontal col-sm-8" role="form" method="POST" action="<?php echo site_url().'md_acc_user_isd/c_acc_user_isd/insert';?>" onSubmit="return confirm('Are you sure want to request ?');">

		<div class="form-group">
			<div class="row">
				<label class="col-sm-3 control-label" style="padding-left:0;">User ISD</label>
				<div class="col-xs-6 col-md-3" style="padding:0">
					<select name="user_isd" id="new_user_isd" class="form-control" style="width:auto;" required autofocus>
						<option value="">Choose</option>
						<?php
						foreach ($data_user_isd as $d)
						{
							?><option value="<?php echo $d['USER_NO']; ?>"><?php echo $d['USER_FNAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<label class="col-sm-3 control-label" style="padding-left:0;">Request Type</label>
				<div class="col-xs-6 col-md-3" style="padding:0">
					<select name="req_type" id="new_req_type" class="form-control" style="width:auto;" required>
						<option value="">Choose</option>
						<?php
						foreach ($req_type as $l)
						{
							?><option value="<?php echo $l['TYPE_NO']; ?>"><?php echo $l['TYPE_NAME']; ?></option><?php
						}
						?>
					</select>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-6 text-center" style="padding:0">
					<button type="button" class="btn" onClick="close_fad()">CANCEL</button>
					<button type="submit" class="btn btn-success" id="btn_submit_form">ADD ACCESS</button>
				</div>
			</div>
		</div>

	</form>
</div>

<div class="row" id="con_data">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-11 datatables">
			<thead>
				<tr>
					<th style="text-align:center;">No.</th>
					<th style="text-align:center;">User Fullname</th>
					<th style="text-align:center;">Request Type</th>
					<th style="text-align:center;">Status Access</th>
					<th style="text-align:center;">Created Date</th>
					<th style="text-align:center;">Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				foreach ($data_acc_user_isd as $d)
				{
					?>
					<tr>
						<th style="text-align:center"><?php echo $n;?></th>
						<td><?php echo $d['USER_FNAME']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						
						<td style="text-align:center;">
							<?php
							$active = $d['ACC_ACTIVE']; 
							if ($active == 1)
							{
								?>
								<a href="#" id="<?php echo $d['ACC_ID']; ?>" onClick="disactivate_acc_user_isd(this.id)"> <img src="<?php echo base_url().'images/icon/true.png';?>"></a>
								<?php
							}
							else
							{
								?>
								<a href="#" id="<?php echo $d['ACC_ID']; ?>" onClick="activate_acc_user_isd(this.id)"><img src="<?php echo base_url().'images/icon/false.png';?>"></a>
								<?php
							}
							?>
						</td>
						
						<td style="text-align:center"><?php echo $d['ACC_CREATED_DATE']; ?></td>
						<td style="text-align:center"><?php echo $d['ACC_LAST_UPDATED']; ?></td>
					</tr>
					<?php
					$n++;
				}
				?>
			</tbody>
		</table>
	</div>
</div>
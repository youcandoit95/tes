<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
	<li class="active"><a href="#new_dept" role="tab" data-toggle="tab">New Dept.</a></li>
	<li><a href="#data_dept" role="tab" data-toggle="tab">Data Dept.</a></li>
</ul>

<!-- Tab panes -->

<div class="tab-content">
	
	<div class="tab-pane fade in active" id="new_dept" style="padding:20px 0px 0px 40px;">
		
		<div class="row">
		<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'md_department/c_dept/dept_new';?>" onSubmit="return confirm('Are you sure want to request ?');">
	
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Name</label>
					<div class="col-xs-6 col-md-3" style="padding:0">
						<input type="text" name="dept_name" id="dept_name" class="form-control" autocomplete="off" required autofocus>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Manager Name</label>
					<div class="col-xs-6 col-md-3" style="padding:0">
						<input type="text" name="dept_mgr_name" id="dept_mgr_name" class="form-control" autocomplete="off" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Email</label>
					<div class="col-xs-6 col-md-3" style="padding:0">
						<input type="email" name="dept_email" id="dept_email" class="form-control" autocomplete="off" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Phone</label>
					<div class="col-xs-6 col-md-3" style="padding:0">
						<input type="text" name="dept_phone" id="dept_phone" class="form-control" autocomplete="off" required>
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
		</div>
		
	</div>

	<div class="tab-pane fade in" id="data_dept" style="padding:10px 0px 0px 18px;">
		
		<div class="row" style="display:none" id="con_fed">
			<form class="form-horizontal col-sm-12" role="form" method="POST" action="<?php echo site_url().'md_department/c_dept/dept_update';?>" onSubmit="return confirm('Are you sure want to edit ?');">
		
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Name</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="hidden" name="dept_no" id="fed_dept_no" readonly required>
							<input type="text" name="dept_name" id="fed_dept_name" class="form-control" autocomplete="off" required autofocus>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Manager Name</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="dept_mgr_name" id="fed_dept_mgr_name" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Email</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="email" name="dept_email" id="fed_dept_email" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 control-label" style="padding-left:0;">Dept. Phone</label>
						<div class="col-xs-6 col-md-3" style="padding:0">
							<input type="text" name="dept_phone" id="fed_dept_phone" class="form-control" autocomplete="off" required>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-center" style="padding:0">
							<button type="submit" class="btn btn-primary" id="btn_submit_form">UPDATE</button>
							<button type="button" class="btn" onClick="close_fed()">CANCEL</button>
						</div>
					</div>
				</div>
				
			</form>
		</div>
		
		<div class="row">
			<div class="col-sm-12 bg-white con-datatables">
				<table class="table table-hover table-striped table-bordered font-12 datatables">
					<thead>
						<tr>
							<th style="text-align:center">No.</th>
							<th style="text-align:center">Dept. Name</th>
							<th style="text-align:center">Dept. Manager Name</th>
							<th style="text-align:center">Dept. Email</th>
							<th style="text-align:center">Dept. Phone</th>
							<th style="text-align:center">Active</th>
							<th style="text-align:center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$n = 1;
						foreach ($dept_data as $d)
						{
							?>
							<tr>
								<th style="text-align:center"><?php echo $d['DEPT_NO']==888 ? $d['DEPT_NO'] : $n;?></th>
							
								<input type="hidden" id="data_record_<?php echo$n; ?>" value="<?php echo $d['DEPT_NO'];?>">
								<input type="hidden" id="data_delete_name_<?php echo$n; ?>" value="<?php echo $d['DEPT_NAME'];?>">
								
								<td><?php echo $d['DEPT_NAME']; ?></td>
								<td><?php echo $d['DEPT_MGR_NAME']; ?></td>
								<td><?php echo $d['DEPT_EMAIL']; ?></td>
								<td><?php echo $d['DEPT_PHONE']; ?></td>
								<td style="text-align:center">
									<?php
									/*
									if ($d->dept_active=="Y")
									{
										?><a href="<?php echo site_url().'department/c_dept/dept_activate/'.$d->dept_id;?>"><img  src="<?php echo base_url().'images/icon/true.png';?>"></a><?php
									}
									else
									{
										?><a href="<?php echo site_url().'department/c_dept/dept_activate/'.$d->dept_id;?>"><img src="<?php echo base_url().'images/icon/false.png';?>"></a><?php
									}*/
									if ($d['DEPT_ACTIVE']==1)
									{
										?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/true.png';?>"></span><?php
									}
									else
									{
										?><span class="ACTV" id="GO_ACTV_<?php echo$n;?>"><img src="<?php echo base_url().'images/icon/false.png';?>"></span><?php
									}
									?>
								</td>
								<td style="text-align:center">
									<input type="image" id="<?php echo $d['DEPT_NO']; ?>" onClick="openFED(this.id)" src="<?php echo base_url().'images/icon/edit.png';?>">
									<input type="image" id="<?php echo $d['DEPT_NO']; ?>" onClick="delete_dept(this.id)" src="<?php echo base_url().'images/icon/delete.png';?>">
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
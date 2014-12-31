<div class="row">
	<div class="col-lg-6">
		<form class="form-horizontal" role="form" method="POST" action="<?PHP echo site_url().'cp/c_cp/cp';?>" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return confirm('Are you sure want to request ?');">
			
			<div class="form-group">
				<div class="row">
					<label class="col-lg-4 control-label-left">Old Password</label>
					<div class="col-lg-5">
						<input type="password" name="old_pass" id="old_pass" class="form-control" autocomplete="off" required autofocus>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label class="col-lg-4 control-label-left">New Password</label>
					<div class="col-lg-5">
						<input type="password" name="new_pass" id="new_pass" class="form-control" autocomplete="off" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label class="col-lg-4 control-label-left">Confirm Password</label>
					<div class="col-lg-5">
						<input type="password" name="conf_pass" id="conf_pass" class="form-control" autocomplete="off" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-12 text-center" style="padding:0">
						<button type="submit" class="btn btn-primary" id="btn_submit_form">SUBMIT</button>
					</div>
				</div>
			</div>
			
		</form>
	</div>
</div>